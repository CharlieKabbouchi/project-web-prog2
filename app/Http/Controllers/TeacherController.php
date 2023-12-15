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
use App\Models\Student;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificate;
use App\Models\Assignment;
use App\Models\StudentClassT;
use App\Models\Submission;
use App\Models\UploadResource;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
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

   
    public function manageClasses()
    {
        $teacher = Auth::guard('teacher')->user();
        $classes = $teacher->getClassT;
        return view('/teacher/manageclasses', compact('classes', 'teacher'));
    }

    public function manageCertificates(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $certificates = $teacher->getCertificate;
        return view('/teacher/managecertifications', compact('certificates', 'teacher'));
    }

    public function editStudentGrades($class_id, $student_id)
    {
        $teacher = Teacher::find(session('teacher_id'));
        $grades = DB::table('student_class_t_s')
            ->where('classt_id', $class_id)
            ->where('student_id', $student_id)
            ->select('averageGrade', 'quizGrade', 'assignmentGrade', 'projectGrade','attendence')
            ->first();

        if ($grades) {
            return view('teacher.editstudent', compact('teacher', 'class_id', 'student_id', 'grades'));
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
                'attendence'=>$request->input('attendence'),
            ]);

        if ($result) {
            return redirect()->route('teacher.viewClass', $class_id);
        } else {
            return redirect()->route('teacher.viewClass', $class_id)->with('error', 'Failed to update grades.');
        }
    }

  
   


    public function create($wteacher)
    {
        $admin = Auth::guard('admin')->user();
        $wteacher = Pending::findOrFail($wteacher);
        return view('teacher.addTeacher', compact('admin', 'wteacher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
            'email' => 'required|email',
            //'image' => 'required|image',//link
            'phone' => 'required',
            'DOB' => 'required'
        ]);

        $te = new Teacher();
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();
        $pending = Pending::where('email', $request->email)->where('phone', $request->phone);
        $pending->delete();
        $prf = new Profile();
        $prf->phone = $request->phone;
        $prf->email = $request->email;
        $prf->image = "NO IMAGE";
        $prf->dateOfBirth = $request->DOB;
        $prf->teacher_id = $te->id;
        $prf->save();
        return redirect(route("admin.manageTeachers"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $teacher)
    {
        $teacherInfo = Teacher::findOrFail($teacher);
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();


        return view('teacher.viewTeacher', compact('teacherInfo', 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($teacher)
    {
        $teacher = Teacher::findOrFail($teacher);
        $admin = Auth::guard('admin')->user();
        return view('teacher.editTeacher', compact('teacher', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $teacher)
    {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
            // 'email' => 'required|email',
            'phone' => 'required',
            'DOB' => 'required'
        ]);


        $te = Teacher::findOrFail($teacher);
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;

        $prf = $te->getProfile;
        $prf->phone = $request->phone;
        $prf->email = $request->email;
        $prf->dateOfBirth = $request->DOB;
        $prf->save();
        $te->save();

        return redirect(route("admin.manageTeachers"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($teacher)
    {
        $teacher = Teacher::findOrFail($teacher);
        $teacher->delete();
        return redirect(route("admin.manageTeachers"));
    }

    public function viewprofile()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.viewprofile', compact('teacher'));
    }

    public function editprofile($id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.editprofile', compact('teacher'));
    }

    public function updateProfile(Request $request, $id)
    {
        return view('teacher.viewprofile', compact('teacher'));
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
            'certificateImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);
       
        if ($request->hasFile('certificateImage')) {
            $certificate = new Certificate();
            $certificate->description = $request->description;
            $certificate->teacher_id = $teacher->id;
           
            $image = $request->file('certificateImage');
            $fileContents = file_get_contents($image->getPathname());
            $imageName = $teacher->id . time() . '.' . $image->getClientOriginalExtension();
            $filePath = 'certificates/' . $imageName;
          
            // Laravel Storage operations
            $laravelDisk = Storage::disk('gcs');

            // Upload the image using Laravel Storage
            $laravelDisk->put($filePath, $fileContents);

            // Check if the uploaded image exists
            $exists = $laravelDisk->exists($filePath);

            // Get the last modified time of the uploaded image
            $time = $laravelDisk->lastModified($filePath);

            // Firebase Storage operations
            $firebaseStorage = Firebase::storage();
            $firebaseBucket = $firebaseStorage->getBucket();

            // Upload the image to Firebase Storage
            $firebaseObject = $firebaseBucket->upload($fileContents, [
                'name' => $filePath,
            ]);
            // Get the public URL of the uploaded image from Firebase
            $firebaseImageUrl = $firebaseObject->signedUrl(new \DateTime('9999-12-31T23:59:59.999999Z'));
           
            // Save the Firebase image URL to the profile
            $certificate->graduationCertificateImage = $firebaseImageUrl;
            $certificate->save();
            return redirect(route('teacher.manageCertificates'))->with('success', 'Certificate added successfully');
            // dd($firebaseImageUrl);
        }
    }

    public function createA($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.addassignment', compact('teacher', 'classt_id'));
    }

    // public function createQ($classt_id)
    // {
    //     $teacher = Auth::guard('teacher')->user();
    //     return view('teacher.addquiz', compact('teacher','classt_id'));
    // }

    // public function createP($classt_id)
    // {
    //     $teacher = Auth::guard('teacher')->user();
    //     return view('teacher.addproject', compact('teacher','classt_id'));
    // }
    public function createRe($classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.uploadresource', compact('teacher','classt_id'));
    }
    public function storeA(Request $request, $classt_id)
    {
        $teacher = Auth::guard('teacher')->user();
        $this->validate($request, [
            'startingDate' => 'required',
            'endingDate' => 'required',
            'title'=>'required',
           'attachment'=>'required|file|mimes:pdf,doc,docx,xlsx,ppt,pptx,docm,dotx,dotm,xls,xlsm,xlsb,xltx,xltm,xlsm,png,bmp,jpeg,jpg,csv,txt',
        ]);
     
        if ($request->hasFile('attachment')) {
         
            $file = $request->file('attachment');
            $fileContents = file_get_contents($file->getPathname());
            $filename = $teacher->id .time(). '.' . $file->getClientOriginalExtension();
            $filePath = 'assignments/' . $filename;

            // Laravel Storage operations
            $laravelDisk = Storage::disk('gcs');

            // Upload the image using Laravel Storage
            $laravelDisk->put($filePath, $fileContents);

            // Check if the uploaded image exists
            $exists = $laravelDisk->exists($filePath);

            // Get the last modified time of the uploaded image
            $time = $laravelDisk->lastModified($filePath);

            // Firebase Storage operations
            $firebaseStorage = Firebase::storage();
            $firebaseBucket = $firebaseStorage->getBucket();

            // Upload the image to Firebase Storage
            $firebaseObject = $firebaseBucket->upload($fileContents, [
                'name' => $filePath,
            ]);
            // Get the public URL of the uploaded image from Firebase
            $fireleUrl = $firebaseObject->signedUrl(new \DateTime('9999-12-31T23:59:59.999999Z'));

            // Save the Firebase image URL to the profile
          
          
            // dd($firebaseImageUrl);
            $assignment = new Assignment();
            $assignment->title = $request->title;
            $assignment->description = $fireleUrl;
            $assignment->startingDate = $request->startingDate;
            $assignment->endingDate = $request->endingDate;
            $assignment->teacher_id = $teacher->id;
            $assignment->classt_id = $classt_id;
            $assignment->save();
            return redirect()->route('teacher.manageClasses');
         }
     
    }
    public function storeRe(Request $request, $classt_id)
{
    $teacher = Auth::guard('teacher')->user();
    $this->validate($request, [
        'attachment'=>'required|file|mimes:pdf,doc,docx,xlsx,ppt,pptx,docm,dotx,dotm,xls,xlsm,xlsb,xltx,xltm,xlsm,png,bmp,jpeg,jpg,csv,txt',

    ]);
   
    if ($request->hasFile('attachment')) {
    $resource = new UploadResource();
   
    $resource->teacher_id = $teacher->id;
    $resource->classt_id = $classt_id;
  
    $file = $request->file('attachment');
    $fileContents = file_get_contents($file->getPathname());
    $filename = $teacher->id .time(). '.' . $file->getClientOriginalExtension();
    $filePath = 'resources/' . $filename;

    // Laravel Storage operations
    $laravelDisk = Storage::disk('gcs');

    // Upload the image using Laravel Storage
    $laravelDisk->put($filePath, $fileContents);

    // Check if the uploaded image exists
    $exists = $laravelDisk->exists($filePath);

    // Get the last modified time of the uploaded image
    $time = $laravelDisk->lastModified($filePath);

    // Firebase Storage operations
    $firebaseStorage = Firebase::storage();
    $firebaseBucket = $firebaseStorage->getBucket();

    // Upload the image to Firebase Storage
    $firebaseObject = $firebaseBucket->upload($fileContents, [
        'name' => $filePath,
    ]);
    // Get the public URL of the uploaded image from Firebase
    $fireleUrl = $firebaseObject->signedUrl(new \DateTime('9999-12-31T23:59:59.999999Z'));
  
    $resource->attachement = $fireleUrl;
    $resource->save();
    //dd($resource);
    // Save the Firebase image URL to the pr
    return redirect()->route('teacher.manageClasses');}
}



public function viewClass($class){

    $teacher = Auth::guard('teacher')->user();

    $class = ClassT::with([
        'getStudents',
        'getReviewC',
        'getAssignment',
        'getSemester',
        'getCourse',
    ])->where('id', $class)
        ->where('teacher_id', $teacher->id)
        ->first();

    if (!$class) {
        return abort(404);
    }

    $semester = $class->getSemester;
    $course = $class->getCourse;
    $classInfo = $class->toArray();
    $students = $class->getStudents->toArray();
    return view('teacher.viewClasses', compact('teacher', 'classInfo', 'students','course','semester','class'));
}
public function gradingStudent($studentId,$classId)
{
    $student = Student::find($studentId);
    $teacher = Auth::guard('teacher')->user();
    $submissions = $student->getSubmission()
        ->whereHas('getAssignment', function ($query) use ($classId) {
            $query->where('classt_id', $classId);
        })
        ->with('getAssignment', 'getAssignment.getTeacher', 'getAssignment.getClassT')
        ->get();

    return view('teacher.studentGrading', compact('teacher','student', 'submissions'));
}


public function putGrade($submissionId)
{
    $teacher = Auth::guard('teacher')->user();
    $submission=Submission::findOrFail($submissionId);
    return view('teacher.putGrade',compact('student','submission'));
}
public function saveGrade(Request $request)
{
    $this->validate($request, [
        'grade'=>'required',

    ]);
    $submission=Submission::findOrFail($request->submissionId);
    $teacher = Auth::guard('teacher')->user();
    $submission->grade=$request->grade;
    $std_class=StudentClassT::where('student_id',$submission->student_id)->where('classt_id',$submission->getAssignment->classt_id);
    if($submission->fileType=="quiz")
    {
        

    }
    elseif($submission->fileType=="project"){
        $std_class->projectGrade=$request->grade;
        $std_class->averageGrade= ($std_class->quizGrade+$std_class->projectGrade+$std_class->assignmentGrade)/3;
    }
    else{
        $std_class->assignmentGrade=$request->grade;
        $std_class->averageGrade= ($std_class->quizGrade+$std_class->projectGrade+$std_class->assignmentGrade)/3;
    }

    $submission->save();
    $std_class->save();
    return redirect(route('teacher.studentgrading',['studentId'=>$submission->student_id,'classId'=>$submission->getAssignment->classt_id]));
}
}