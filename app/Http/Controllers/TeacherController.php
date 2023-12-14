<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Pending;
use App\Models\Profile;
use App\Models\Semester;
use App\Models\Student;
use App\Models\UploadResource;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Storage;

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
        $teacher = Auth::guard('teacher')->user();
        $request->validate([
            'graduationCertificateImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        if($request->hasFile('certificateImage')){
            $filename = time().'-'.$request->file('certificateImage')->getClientOriginalName();
            request->file('certificateImage')->storeAs('Certificates',$filename);
            $imagePath = "storage/Certificates/".$filename;
            $certificate = new Certificate();
            $certificate->graduationCertificateImage = $imagePath;
            $certificate->description = $request->description;
            $certificate->teacher_id = $teacher->id;
            $certificate->save();
            return redirect(route('teacher.manageCertificates'))->with('success', 'Certificate added successfully');
            }else{
                return "No data found";
            }
    }

    public function createA($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.addassignment', compact('teacher','classt_id'));
    }

    public function createQ($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.addquiz', compact('teacher','classt_id'));
    }

    public function createP($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.addproject', compact('teacher','classt_id'));
    }

    public function createRe($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.uploadresource', compact('teacher','classt_id'));
    }

    public function storeA(Request $request, $classt_id)
{
    $teacher = Auth::guard('teacher')->user();
    $this->validate($request, [
        'startingDate' => 'required|date',
        'endingDate' => 'required|date',
    ]);
    //$storage = Firebase::storage();
    //$storageBucket = $storage->getBucket();
    // $fileUrl = null;

    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $filename = time() . '-' . $file->getClientOriginalName();
    //     $storageObject = $storageBucket->upload($file, [
    //         'name' => $filename,
    //     ]);

    //     $fileUrl = $storageObject->signedUrl(new \DateTime('+5 minutes'));
    // }
    $fileUrl = 'FileUrlA';
    $assignment = new Assignment();
    $assignment->title = 'assignment';
    $assignment->description = $fileUrl;
    $assignment->startingDate = $request->startingDate;
    $assignment->endingDate = $request->endingDate;
    $assignment->teacher_id = $teacher->id;
    $assignment->classt_id = $classt_id;
    $assignment->save();
    return redirect()->route('teacher.manageClasses');
}

public function storeQ(Request $request, $classt_id)
{
    $teacher = Auth::guard('teacher')->user();
    $this->validate($request, [
        'startingDate' => 'required|date',
        'endingDate' => 'required|date',
    ]);
    //$storage = Firebase::storage();
    //$storageBucket = $storage->getBucket();
    // $fileUrl = null;

    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $filename = time() . '-' . $file->getClientOriginalName();
    //     $storageObject = $storageBucket->upload($file, [
    //         'name' => $filename,
    //     ]);

    //     $fileUrl = $storageObject->signedUrl(new \DateTime('+5 minutes'));
    // }
    $fileUrl = 'FileUrlQ';
    $quiz = new Assignment();
    $quiz->title = 'quiz';
    $quiz->description = $fileUrl;
    $quiz->startingDate = $request->startingDate;
    $quiz->endingDate = $request->endingDate;
    $quiz->teacher_id = $teacher->id;
    $quiz->classt_id = $classt_id;
    $quiz->save();
    return redirect()->route('teacher.showClass');
}

public function storeP(Request $request, $classt_id)
{
    $teacher = Auth::guard('teacher')->user();
    $this->validate($request, [
        'startingDate' => 'required|date',
        'endingDate' => 'required|date',
    ]);
    // $storage = Firebase::storage();
    // $storageBucket = $storage->getBucket();
    // $fileUrl = null;

    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $filename = time() . '-' . $file->getClientOriginalName();
    //     $storageObject = $storageBucket->upload($file, [
    //         'name' => $filename,
    //     ]);
    //     $fileUrl = $storageObject->signedUrl(new \DateTime('+5 minutes'));
    // }
    $fileUrl = 'FileUrlP';
    $project = new Assignment();
    $project->title = 'project';
    $project->description = $fileUrl;
    $project->startingDate = $request->startingDate;
    $project->endingDate = $request->endingDate;
    $project->teacher_id = $teacher->id;
    $project->classt_id = $classt_id;
    $project->save();

    return redirect()->route('teacher.manageClasses');
}

public function storeRe(Request $request, $classt_id)
{
    $teacher = Auth::guard('teacher')->user();
    
    //$storage = Firebase::storage();
    //$storageBucket = $storage->getBucket();
    // $fileUrl = null;

    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $filename = time() . '-' . $file->getClientOriginalName();
    //     $storageObject = $storageBucket->upload($file, [
    //         'name' => $filename,
    //     ]);

    //     $fileUrl = $storageObject->signedUrl(new \DateTime('+5 minutes'));
    // }
    $fileUrl = 'Resource';
    $resource = new UploadResource();
    $resource->attachement = $fileUrl;
    $resource->teacher_id = $teacher->id;
    $resource->classt_id = $classt_id;
    $resource->save();
    return redirect()->route('teacher.manageClasses');
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
