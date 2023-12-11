<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Pending;
use App\Models\Profile;
use App\Models\Semester;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller {
    /**
     * Display a listing of the resource.
     */
    // public function showLoginForm() {
    //     return view('auth.teacher-login');
    // }
    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('teacher')->attempt($credentials)) {
    //         $teacher = Auth::guard('teacher')->user();
    //         $request->session()->put('teacher_id', $teacher->id);
    //         return redirect()->intended('/teacher/dashboard');
    //     }

    //     return back()->withErrors(['error' => 'Invalid login credentials']);
    // }
   

    public function showDashboard(Request $request) {

        //$teacher = Teacher::find(session('teacher_id'));
        // $teacherId = $request->session()->get('teacher_id');
        // $teacherId = session('teacher_id');
        // $teacher = Auth::guard('teacher')->user();
        // dd($alumni);
        $teacher = Teacher::find('t20230001');
        $totalClasses = $teacher->getClassT()->count();

        $courses = $teacher->getClassT()->pluck('course_id')->unique();
        $departments = Department::whereIn('id', function ($query) use ($courses) {
        $query->select('department_id')
            ->from('department_courses')
            ->whereIn('course_id', $courses);
        })->get();
        $totalDepartments = $departments->count();

        $totalUploadedResources = $teacher->getUploadResource()->count();

        return view('teacher.dashboard', compact('teacher','totalClasses','totalDepartments',
        'totalUploadedResources'));
    }



    public function index() {
       
    }

    public function create($wteacher) {
        $admin = Auth::guard('admin')->user();
        $wteacher=Pending::findOrFail($wteacher);
        return view('teacher.addTeacher', compact('admin','wteacher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

         $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
            'email' => 'required|email',
            //'image' => 'required|image',//link
           'phone'=>'required',
           'DOB' =>'required'
        ]);

        $te = new Teacher();
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();
        $pending=Pending::where('email',$request->email)->where('phone',$request->phone);
        $pending->delete();
        $prf=new Profile();
        $prf->phone=$request->phone;
        $prf->email=$request->email;
        $prf->image="sdf";
        $prf->dateOfBirth=$request->DOB;
        $prf->teacher_id=$te->id;
        $prf->save();
        return redirect(route("admin.manageTeachers"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$teacher) {
        $teacherInfo=Teacher::findOrFail($teacher);
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();

   
        return view('teacher.viewTeacher', compact('teacherInfo', 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($teacher) {
        $teacher = Teacher::findOrFail($teacher);
        $admin = Auth::guard('admin')->user();
        return view('teacher.editTeacher', compact('teacher', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $teacher) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
            'email' => 'required|email',
           'phone'=>'required',
           'DOB' =>'required'
        ]);
          //'image' => 'required|image',//link
    
        $te=Teacher::findOrFail($teacher);
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;

        $prf=$te->getProfile;
        $prf->phone=$request->phone;
        $prf->email=$request->email;
        $prf->image="sdfsfs";//$request->image;
        $prf->dateOfBirth=$request->DOB;
        $prf->save();
        $te->save();

        return redirect(route("admin.manageTeachers"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($teacher) {
        $teacher=Teacher::findOrFail($teacher);
        $teacher->delete();
        return redirect(route("admin.manageTeachers")); 
    }
}
