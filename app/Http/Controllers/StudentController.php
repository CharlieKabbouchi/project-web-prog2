<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SParent;
use App\Models\Pending;
use App\Models\Department;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function manageEvent(Request $request)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $events = $student->getEvent()->get();

    
        $eventDetails = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'description' => $event->description,
                'type' => $event->type,
                'startingTime' => $event->startingtime,
                'endingTime' => $event->endingtime,
                'time' => $event->time,
            ];
    });
        return view('student.manageevents',compact('eventDetails'));
    }

    public function enrollEvent()
    {
        return view('student.enrollToEvent');
    }

    public function addReviewc()
    {
        return view('student.addreviewc');
    }

    public function viewEvent(Request $request,$id)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $event = Event::find($id);

    if ($event && $student->getEvent->contains($event)) {
 
        $alumni = Student::find($event->alumni_id);
        $alumniName = $alumni ? $alumni->firstName . ' ' . $alumni->lastName : 'Unknown';

        $eventDetails = [
            'title' => $event->title,
            'description' => $event->description,
            'type' => $event->type,
            'startingTime' => $event->startingtime,
            'endingTime' => $event->endingtime,
            'time' => $event->time,
            'alumniName' => $alumniName,
        ];

        return view('viewevent', compact('eventDetails'));
        }
    }

    public function addEvent()
    {
        return view('viewevent',compact(''));
    }

    public function manageQandA()
    {
        return view('student.manageQ&A');
    }

    public function manageCalendar()
    {
        return view('student.manageCalendar');
    }

    public function enrollClass()
    {
        //
    }

    public function viewProfile()
    {
        //
    }

    public function editProfile()
    {
        //
    }

    public function viewSubmission(Request $request,$id)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $classId = $id;

        $submissions = Submission::where('student_id', $student->id)
            ->whereHas('assignment', function ($query) use ($id) {
                $query->where('classt_id', $id);
            })
            ->with('assignment') 
            ->get();

        $submissionDetails = $submissions->map(function ($submission) {
            return [
                'fileType' => $submission->fileType,
                'grade' => $submission->grade,
                'timeOfSubmission' => $submission->timeOfSubmission,
                'attachmentLink' => $submission->attachmentlink,
            ];
        });

        return view('student.viewsubmission',compact('submissionDetails'));
    }

    public function viewAssignment(Request $request,$id)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $classId = $id;

        $teacher = $class->teacher()->first();
        $assignments = Assignment::where('classt_id', $id)->get();

        $assignmentDetails = $assignments->map(function ($assignment) {
            return [
                'assignmentType' => $assignment->title,
                'startingDate' => $assignment->startingDate,
                'endingDate' => $assignment->endingDate,
            ];
        });

        return view('student.viewassignments', compact('student', 'class', 'assignmentDetails','teacher'));
    }

    public function addSubmission(Request $request,$id)
    {
        return view('student.addsubmission',compact(''));
    }

    public function viewResource(Request $request,$id)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $classId = $id;

        $resources = UploadResource::where('classt_id', $id)
            ->with('teacher')
            ->get();

       
        $resourceDetails = $resources->map(function ($resource) {
            $teacherName = $resource->teacher->firstName . ' ' . $resource->teacher->lastName;

            return [
                'attachment' => $resource->attachment,
                'teacherName' => $teacherName,
            ];
        });

        return view('student.viewresources',compact('resourceDetails'));
    }

    public function viewClass(Request $request,$id)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $classId = $id;
        
        $classDetails = $student->getClassT()->where('classt_id', $classId)->with('getCourse')->first();
        $courseName = $classDetails->getCourse->name;
        
        $details = [
            'course' => $courseName,
            'teacher' => $teacherName,
            'attendance' => $classDetails->attendence,
            'averageGrade' => $classDetails->averageGrade,
            'quizGrade' => $classDetails->quizGrade,
            'projectGrade' => $classDetails->projectGrade,
            'assignmentGrade' => $classDetails->assignmentGrade,
        ];
        return view('student.viewclass',compact('Details'));
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $request->session()->put('student_id', $student->id);
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }
  
    public function showDashboard(Request $request) {
        
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();
        //dd($alumni);

        foreach ($students as $student) {
            $classes[$student->id] = $student->getClassT()->with(['getCourse', 'getCourse'])->withPivot('averageGrade')->get() ?? [];
        }

        $studentData = [];
    
        foreach ($students as $student) {
            $totalClassesTaken = count($classes[$student->id]);
            $totalWeightedGrade = 0;
            $totalCredits = 0;
    
            foreach ($classes[$student->id] as $class) {
                $totalWeightedGrade += $class->pivot->averageGrade * $class->getCourse->credits;
                $totalCredits += $class->getCourse->credits;
            }
    
            $gpa = ($totalCredits > 0) ? $totalWeightedGrade / $totalCredits : 0;
            $remainingCredits = $totalCredits - $totalCreditsTaken;
            $studentData[] = [
                'totalCreditsTaken' => $student->totalCreditsTaken,
                'totalCredits' => $student->getDepartment->totalCredits,
                'totalClassesTaken' => $totalClassesTaken,
                'gpa' => $gpa,
                'remainingCredits' => $remainingCredits,
                // 'classes' => $classes[$student->id],
            ];
        }

        return view('student.dashboard', compact('student', 'studentData'));
    }

    public function manageClass(Request $request)
    {
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();

        $enrolledCourses = $student->getClassT()->with('getCourse')->get()->pluck('getCourse');

        return view('/student/manageclass',compact('enrolledCourses',));
    }
    

    //Management
    public function index()
    {
        $stds=Student::all();
        return redirect()->intended('/student/allstudents')->with('stds', $stds);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($wstudent)
    {
        $admin = Auth::guard('admin')->user();
        $wstudent= Pending::findOrFail($wstudent);
        $parents=SParent::all();
        $deps=Department::all();
        return view('student.addStudent', compact('admin','wstudent','parents','deps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','parent'=> 'required','Department'=> 'required', 'email' => 'required|email',
        // 'phone'=>'required',
        // 'DOB' =>'required']);
        $nstd=new Student();
        $nstd->firstName=$request->firstname;
        $nstd->lastName=$request->lastname;
        $nstd->Gender=$request->Gender;
        $nstd->sparent_id=$request->Parent;
        $nstd->department_id=$request->Department;
        $nstd->save();  
        $prf=new Profile();
        $prf->student_id=$nstd->id; 
        $prf->phone=$request->phone;
        $prf->email=$request->email;
        $prf->image="sdfsfs";//$request->image;
        $prf->dateOfBirth=$request->DOB;
        $prf->save();
        $pending=Pending::where('email',$request->email)->where('phone',$request->phone);
        $pending->delete();
        return redirect(route("admin.manageStudents")); 
    }

    /**
     * Display the specified resource.
     */
    public function show($student)
    {
        $studentInfo=Student::findOrFail($student);
        
        $classes = [];
    
            $classes[$studentInfo->id] = $studentInfo->getClassT()->with(['getCourse'])->withPivot('averageGrade')->get() ?? [];

        $studentData = [];
    
      
            $totalClassesTaken = count($classes[$studentInfo->id]);
            $totalWeightedGrade = 0;
            $totalCredits = 0;
    
            foreach ($classes[$studentInfo->id] as $class) {
                $totalWeightedGrade += $class->pivot->averageGrade * $class->getCourse->credits;
                $totalCredits += $class->getCourse->credits;
            }
    
            $gpa = ($totalCredits > 0) ? $totalWeightedGrade / $totalCredits : 0;
    
            $studentData[] = [
                'name' => $studentInfo->firstName . ' ' . $studentInfo->lastName,
                'totalCreditsTaken' =>$totalCredits,
                'totalCredits' => $studentInfo->getDepartment->totalCredits,
                'totalClassesTaken' => $totalClassesTaken,
                'gpa' => $gpa,
                'classes' => $classes[$studentInfo->id],
            ];

            //dd($studentData);
        $admin = Auth::guard('admin')->user();
        return view('student.viewStudent', compact('studentData', 'admin'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $student)
    {
        $wstudent=Student::findOrFail($student);
       // dd($wstudent);
        $admin= Auth::guard('admin')->user();
        $parents=SParent::all();
        $departments=Department::all();
        return view('student.editStudent',compact('admin','wstudent','parents','departments')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$student)
    {
       
        // $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','parent'=> 'required','Department'=> 'required', 'email' => 'required|email',
        // 'phone'=>'required',
        // 'DOB' =>'required']);

        $estd = Student::findOrFail($student);
        $estd->firstName=$request->firstname;
        $estd->lastName=$request->lastname;
        $estd->Gender=$request->Gender;
        $estd->sparent_id=$request->Parent;
        $estd->department_id=$request->Department;
        $estd->save();
       // $prf = Profile::where('student_id',$student);
       $prf=$estd->getProfile; 
        $prf->phone=$request->phone;
        $prf->email=$request->email;
        $prf->image="sdfsfs";//$request->image;
        $prf->dateOfBirth=$request->DOB;
        $prf->save();
        return redirect(route("admin.manageStudents")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($student)
    {
        $dstd=Student::findOrFail($student);
        $dstd->delete($dstd);
        return redirect(route("admin.manageStudents")); 
    }
}
