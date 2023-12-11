<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm() {
        return view('auth.teacher-login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            $teacher = Auth::guard('teacher')->user();
            $request->session()->put('teacher_id', $teacher->id);
            return redirect()->intended('/teacher/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }
   

    public function showDashboard(Request $request) {
        $teacher = Teacher::find(session('teacher_id'));
        // $teacherId = $request->session()->get('teacher_id');
        // $teacherId = session('teacher_id');
        // $teacher = Auth::guard('teacher')->user();
        // dd($alumni);
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

    public function manageClasses(Request $request)
    {
       $teacher = Auth::guard('teacher')->user();
       $classes = $teacher->getClassT()->get();
       return view('/teacher/manageclasses',compact('classes','teacher'));
    }

    public function manageCertificates(Request $request)
    {
       $teacher = Auth::guard('teacher')->user();
       $certificates = $teacher->getCertificate()->get();
       return view('/teacher/managecertifications',compact('certificates','teacher'));
    }

    public function editStudentGrades($class_id, $student_id)
    {
        $teacher = Teacher::find(session('teacher_id'));
        $grades = DB::table('student_class_t_s')
            ->where('classt_id', $class_id)
            ->where('student_id', $student_id)
            ->select('averageGrade', 'quizGrade', 'assignmentGrade', 'projectGrade')
            ->first();

        if ($grades) {
            return view('teacher.editstudent', compact('teacher','class_id', 'student_id', 'grades'));
        } else {
            return redirect()->route('your_error_route')->with('error', 'Grades not found for the specified student in the class.');
        }
    }

    public function storeStudentGrades($class_id, $student_id, Request $request)
    {
        $request->validate([
            'averageGrade' => 'required|numeric',
            'quizGrade' => 'required|numeric',
            'projectGrade' => 'required|numeric',
            'assignmentGrade' => 'required|numeric',
        ]);

        $result = DB::table('student_class_t_s')
            ->where('classt_id', $class_id)
            ->where('student_id', $student_id)
            ->update([
                'averageGrade' => $request->input('averageGrade'),
                'quizGrade' => $request->input('quizGrade'),
                'projectGrade' => $request->input('projectGrade'),
                'assignmentGrade' => $request->input('assignmentGrade'),
            ]);

        if ($result) {
            return redirect()->route('teacher.showClass', $class_id);
        } else {
            return redirect()->route('teacher.showClass', $class_id)->with('error', 'Failed to update grades.');
        }
    }

    public function createC()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.addcertificate', compact('teacher'));
    }

    public function storeC(Request $request)
    {
        $request->validate([
            'graduationCertificateImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);
        $teacher = Auth::guard('teacher')->user();

        $imagePath = $request->file('certificateImage')->storeAs('public/certificates', 'certificate_' . time() . '.' . $request->file('certificateImage')->getClientOriginalExtension());
        $certificate = new Certificate([
            'graduationCertificateImage' => $imagePath,
            'description' => $request->input('description'),
            'teacher_id' => $teacher->id,
        ]);
        $certificate->save();
        return redirect(route('teacher.manageCertificates'))->with('success', 'Certificate added successfully');
    }

    public function index() {
        $teacher = Teacher::all();
        return redirect()->intended('/teacher/allteachers')->with('teacher', $teacher);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return redirect()->intended('/teacher/addteacher');
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
        ]);

        $te = new Teacher();
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();

        return redirect(route('teacher.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher) {
        $te=Teacher::findOrFail($teacher);
        return redirect()->intended('/teacher/editteacher')->with('teacher', $te);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
        ]);
    
        $te=Teacher::findOrFail($teacher);
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();

        return redirect(route('teacher.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher) {
        $teacher->delete();
        return redirect(route("teacher.index")); 
    }
}
