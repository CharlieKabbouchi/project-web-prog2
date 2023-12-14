<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\SParent;
use App\Models\Pending;
use App\Models\Department;
use App\Models\Event;
use App\Models\Profile;
use App\Models\Question;
use App\Models\ReviewE;
use App\Models\StudentClassT;
use App\Models\Submission;
use App\Models\UploadResource;
use App\Models\ReviewC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller {

    public function showLoginForm() {
        return view('auth.student-login');
    }

    public function manageEvent(Request $request) {
        $student = Student::find(session('student_id'));

        $events = $student->getEvent()->get();


        $eventDetails = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'type' => $event->type,
                'startingTime' => $event->startingtime,
                'endingTime' => $event->endingtime,
                'time' => $event->time,
            ];
        });
        return view('student.manageevents', compact('student', 'eventDetails'));
    }

    public function enrollEvent(Request $request, $eventId) {
        $student = Student::find(session('student_id'));
        $event = Event::find($eventId);
        if ($student && $event) {
            if (!$student->getEvent->contains($event)) {
                $student->getEvent()->attach($event);

                return redirect()->route('student.manageevents', ['id' => $event->id])->with('success', 'Enrolled in the event successfully!');
            } else {
                return redirect()->route('student.manageevents', ['id' => $event->id])->with('error', 'You are already enrolled in this event.');
            }
        }

        return redirect()->route('student.dashboard')->with('error', 'Failed to enroll in the event.');
    }

    public function showAllEvents() {
        $student = Student::find(session('student_id'));
        $allEvents = Event::all();

        return view('student.enrollToEvent', compact('student', 'allEvents'));
    }

    public function addReviewc($classId) {
        $student = Student::find(session('student_id'));
        $class = ClassT::find($classId);
        // dd($class);
        return view('student.addreviewc', compact('student', 'class', 'classId'));
    }

    public function storeReviewc(Request $request) {
        $student = Student::find(session('student_id'));

        $review = new ReviewC();

        // Retrieve class using the classId from the form
        $classId = $request->input('classId');
        $class = ClassT::find($classId);

        if (!$class) {
            return redirect()->route('student.manageclass')->with('error', 'Class not found');
        }

        $review->classt_id = $class->id;
        $review->description = $request->input('description');
        $review->rating = $request->input('rating');
        $review->student_id = session('student_id');
        $review->save();

        return redirect()->route('student.manageclass')->with('success', 'Review added successfully');
    }


    public function addReviewE(Request $request, $eventId) {
        $event = Event::find($eventId);

        $student = Student::find(session('student_id'));

        if (!$event) {
            return redirect()->route('student.events')->with('error', 'Event not found.');
        }

        $existingReview = ReviewE::where('event_id', $eventId)
            ->where('student_id', session('student_id'))
            ->first();


        if (!$existingReview) {
            return view('student.addReviewE', compact('event', 'student'));
        } else {
            return redirect()->route('student.viewEvent', ['id' => $eventId])
                ->with('error', 'You have already submitted a review for this event.');
        }
    }

    public function viewEvent(Request $request, $id) {
        $student = Student::find(session('student_id'));

        $event = Event::find($id);

        if ($event && $student->getEvent->contains($event)) {

            $alumni = Student::find($event->alumni_id);
            $alumniName = $event->getAlumni->getStudent->firstName . " " . $event->getAlumni->getStudent->lastName;

            $eventDetails = [
                'title' => $event->title,
                'description' => $event->description,
                'type' => $event->type,
                'startingTime' => $event->startingtime,
                'endingTime' => $event->endingtime,
                'time' => $event->time,
            ];

            return view('student.viewevent', compact('student', 'eventDetails', 'event', 'alumniName'));
        }
    }

    public function submitReviewE(Request $request, $eventId) {

        $request->validate([
            'description' => 'required',
            'rating' => 'required|numeric|between:1,5',
        ]);


        ReviewE::create([
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'event_id' => $eventId,
            'student_id' => session('student_id'),
        ]);

        return redirect()->route('student.viewEvent', ['id' => $eventId]);
    }
    public function addEvent() {
        return view('viewevent', compact(''));
    }

    public function manageQandA() {
        $student = Student::with('questions.getAnswer')->find(session('student_id'));

        return view('student.manageQ&A', compact('student'));
    }

    public function addQuestion() {
        return view('student.addQuestion');
    }

    public function storeQuestion(Request $request) {

        $question = new Question();
        $question->description = $request->input('description');
        $question->student_id = session('student_id');
        $question->save();

        return redirect()->route('student.manageQandA')->with('success', 'Question added successfully');
    }

    public function manageCalendar() {
        return view('student.manageCalendar');
    }
    public function viewCalendar() {
        return view('student.viewCalendar');
    }

    public function enrollClass() {
        $student = Student::find(session('student_id'));

        $allClasses = ClassT::all();
        // dd($allClasses);

        $enrolledClasses = $student->getClassT;

        // dd($enrolledClasses);
        $unenrolledClasses = $allClasses->reject(function ($class) use ($enrolledClasses) {
            return $enrolledClasses->contains('id', $class->id);
        });

        // dd($unenrolledClasses);

        $classesDetail = $unenrolledClasses->map(function ($class) {
            return [
                'classId' => $class->id,
                'CourseName' => $class->getCourse->name,
                'Semester' => $class->getSemester->yearBelongsTo . "-" . $class->getSemester->type,
                'Day' => $class->DayofWeek,
                'startingTime' => $class->starttime,
                'endingTime' => $class->endtime,
                'teacher' => $class->getTeacher->firstName . " " . $class->getTeacher->lastName
            ];
        });
        // dd($classesDetail);
        return view('student.enrollClass', compact('classesDetail', 'student'));
    }
    public function enroll(Request $request, $classId) {
        $studentId = $request->session()->get('student_id');
        $student = Student::find($studentId);

        $class = ClassT::find($classId);

        $student->getClassT()->attach($class);

        return redirect()->route('student.manageclass')->with('success', 'Enrollment successful!');
    }
    public function viewProfile() {
        //
    }

    public function editProfile() {
        //
    }

    public function viewSubmission(Request $request, $class) {
        $student = Student::find(session('student_id'));
     
        $submissions = Submission::where('student_id', $student->id)
            ->whereHas('getAssignment', function ($query) use ($class) {
                $query->where('classt_id', $class);
            })->get();

        $submissionDetails = $submissions->map(function ($submission) {
            return [
                'fileType' => $submission->fileType,
                'grade' => $submission->grade,
                'timeOfSubmission' => $submission->timeOfSubmission,
                'attachmentLink' => $submission->attachmentlink,
            ];
        });
        //dd( $submissionDetails);
        return view('student.viewsubmission', compact('submissionDetails','student'));
    }

    public function viewAssignment(Request $request, $class) {
        $student = Student::find(session('student_id'));
        $assignments = Assignment::where('classt_id', $class)->get();
        
        $assignmentDetails = $assignments->map(function ($assignment) use ($student) {
        
            $submissions = Submission::where('student_id', $student->id)
                ->where('assignment_id', $assignment->id)
                ->get();
            $isSubmitted = $submissions->isNotEmpty();
            $isWithinDeadline = Carbon::now()->lt(Carbon::parse($assignment->endingDate));
    
            return [
                'assignmentId' => $assignment->id,
                'assignmentType' => $assignment->title,
                'startingDate' => $assignment->startingDate,
                'endingDate' => $assignment->endingDate,
                'isSubmitted' => $isSubmitted,
                'isWithinDeadline' => $isWithinDeadline,
            ];
        });
    
        return view('student.viewassignments', compact('student', 'class', 'assignmentDetails'));
    
    }

    public function addSubmission(Request $request, $assignment) {
        $student = Student::find(session('student_id'));
        $assignment=Assignment::find( $assignment);
        return view('student.addsubmission', compact('student','assignment'));
    }
    public function submitAssignment(Request $request)
{
    // Validate the form data
    $request->validate([
        'attachment' => 'required|file|mimes:pdf,doc,docx,xlsx,ppt,pptx,docm,dotx,dotm,xls,xlsm,xlsb,xltx,xltm,xlsm,png,bmp,jpeg,jpg',
        'assignment_id' => 'required|exists:assignments,id',
        'classt_id'=>'required',
    ]);

    // Store the uploaded file
    $attachmentPath = $request->file('attachment')->store('attachments', 'public');
    $student = Student::find(session('student_id'));
    $nsub=new Submission();
    $nsub->fileType="word";
    $nsub->attachmentlink="sdfsdfs";
    $nsub->grade=0;
    $nsub->timeOfSubmission=now();
    $nsub->assignment_id=$request->input('assignment_id');
    $nsub->student_id=$student->id;
    $nsub->save();
    // Submission::create([
    //     'fileType' => $request->file('attachment')->getClientOriginalExtension(),
    //     'attachmentlink' => "sdfsf",
    //     'timeOfSubmission' => now(),
    //     'assignment_id' => $request->input('assignment_id'),
    //     'student_id' => $student->id, 
    // ]);
    

    return redirect(route('student.viewassignments',['class'=>$request->classt_id]));
}

    public function viewResource(Request $request, $class) {
        $student = Student::find(session('student_id'));

    

        $resources = UploadResource::where('classt_id', $class)->get();


        $resourceDetails = $resources->map(function ($resource) {
            $teacherName = $resource->getTeacher->firstName . ' ' . $resource->getTeacher->lastName;

            return [
                'attachment' => $resource->attachement,
                'teacherName' => $teacherName,
            ];
        });

        return view('student.viewresources', compact('resourceDetails','student'));
    }

    public function viewClass(Request $request, $id) {
        $student = Student::find(session('student_id'));

        $class = ClassT::find($id);
        $classDetails = StudentClassT::select('student_id', 'classt_id', 'attendence', 'averageGrade', 'quizGrade', 'projectGrade', 'assignmentGrade')
            ->where('classt_id', $id)
            ->where('student_id', $student->id)
            ->get();
        // $course = Course::find($id);

        $courseName = $class->getCourse->name;
        $classReviews = $class->getReviewC;
        // dd($classDetails);
        $details = [
            'course' => $courseName,
            'teacher' => $class->getTeacher->firstName . " " . $class->getTeacher->lastName,
            'classDetails' => $classDetails,
            'Time'=>$class->DayofWeek.":".$class->starttime."-".$class->endtime,
            // 'classReviews' => $classReviews,
            // 'attendance' => $classDetails->attendence,
            // 'averageGrade' => $classDetails->averageGrade,
            // 'quizGrade' => $classDetails->quizGrade,
            // 'projectGrade' => $classDetails->projectGrade,
            // 'assignmentGrade' => $classDetails->assignmentGrade,
        ];

        // dd($student);

        return view('student.viewclass', compact('details', 'student', 'classReviews')); // 'course'
    }

    public function Logout() {
        auth()->guard('student')->logout();
        return redirect('/');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $request->session()->put('student_id', $student->id);
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function showDashboard(Request $request) {

        $classes = [];
        $student = Auth::guard('student')->user();
        $studentinfo = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $classes[$student->id] = $studentinfo->getClassT()->with(['getCourse', 'getSemester'])->withPivot('averageGrade')->get() ?? [];

        $studentData = [];

        // Calculate overall GPA
        $totalClassesTaken = count($classes[$studentinfo->id]);
        $totalWeightedGrade = 0;
        $totalCredits = 0;

        foreach ($classes[$studentinfo->id] as $class) {
            $totalWeightedGrade += $class->pivot->averageGrade * $class->getCourse->credits;
            $totalCredits += $class->getCourse->credits;
        }

        $overallGPA = ($totalCredits > 0) ? $totalWeightedGrade / $totalCredits : 0;

        $semesterlyGPA = [];

        foreach ($classes[$studentinfo->id] as $class) {
            $semester = $class->getSemester->yearBelongsTo . $class->getSemester->type; // Adjust this based on your actual attribute for the semester name

            if (!isset($semesterlyGPA[$semester])) {
                $semesterlyGPA[$semester] = [
                    'totalWeightedGrade' => 0,
                    'totalCredits' => 0,
                    'totalClassesTaken' => 0,
                    'gpa' => 0,
                ];
            }

            $semesterlyGPA[$semester]['totalWeightedGrade'] += $class->pivot->averageGrade * $class->getCourse->credits;
            $semesterlyGPA[$semester]['totalCredits'] += $class->getCourse->credits;
            $semesterlyGPA[$semester]['totalClassesTaken']++;
        }

        foreach ($semesterlyGPA as $semester => $data) {
            $semesterlyGPA[$semester]['gpa'] = ($data['totalCredits'] > 0) ? $data['totalWeightedGrade'] / $data['totalCredits'] : 0;
        }

        $studentData[] = [
            'name' => $studentinfo->firstName . ' ' . $studentinfo->lastName,
            'totalCreditsTaken' => $totalCredits,
            'totalCredits' => $studentinfo->getDepartment->totalCredits,
            'totalClassesTaken' => $totalClassesTaken,
            'overallGPA' => $overallGPA,
            'semesterlyGPA' => $semesterlyGPA,
            'classes' => $classes[$studentinfo->id],
        ];
        //dd($studentData);

        return view('student.dashboard', compact('studentData', 'student'));
    }
    public function manageClass() {

        $student = Student::find(session('student_id'));

        $classes = $student->getClassT;


        $classesDetail = $classes->map(function ($class) {
            return [
                'classId' => $class->id,
                'CourseName' => $class->getCourse->name,
                'Semester' => $class->getSemester->yearBelongsTo . "-" . $class->getSemester->type,
                'Day' => $class->DayofWeek,
                'startingTime' => $class->starttime,
                'endingTime' => $class->endtime,
                'teacher' => $class->getTeacher->firstName . " " . $class->getTeacher->lastName
            ];
        });
        return view('student.manageclass', compact('classesDetail', 'student'));
    }

    //Management
    public function index() {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($wstudent) {
        $admin = Auth::guard('admin')->user();
        $wstudent = Pending::findOrFail($wstudent);
        $parents = SParent::all();
        $deps = Department::all();
        return view('student.addStudent', compact('admin', 'wstudent', 'parents', 'deps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','parent'=> 'required','Department'=> 'required', 'email' => 'required|email',
        // 'phone'=>'required',
        // 'DOB' =>'required']);
        $nstd = new Student();
        $nstd->firstName = $request->firstname;
        $nstd->lastName = $request->lastname;
        $nstd->Gender = $request->Gender;
        $nstd->sparent_id = $request->Parent;
        $nstd->department_id = $request->Department;
        $nstd->save();
        $prf = new Profile();
        $prf->student_id = $nstd->id;
        $prf->phone = $request->phone;
        $prf->email = $request->email;
        $prf->image = "sdfsfs"; //$request->image;
        $prf->dateOfBirth = $request->DOB;
        $prf->save();
        $pending = Pending::where('email', $request->email)->where('phone', $request->phone);
        $pending->delete();
        return redirect(route("admin.manageStudents"));
    }

    /**
     * Display the specified resource.
     */
    public function show($student) {
        $studentInfo = Student::findOrFail($student);

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
            'totalCreditsTaken' => $totalCredits,
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
    public function edit($student) {
        $wstudent = Student::findOrFail($student);
        // dd($wstudent);
        $admin = Auth::guard('admin')->user();
        $parents = SParent::all();
        $departments = Department::all();
        return view('student.editStudent', compact('admin', 'wstudent', 'parents', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $student) {

        // $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','parent'=> 'required','Department'=> 'required', 'email' => 'required|email',
        // 'phone'=>'required',
        // 'DOB' =>'required']);

        $estd = Student::findOrFail($student);
        $estd->firstName = $request->firstname;
        $estd->lastName = $request->lastname;
        $estd->Gender = $request->Gender;
        $estd->sparent_id = $request->Parent;
        $estd->department_id = $request->Department;
        $estd->save();
        // $prf = Profile::where('student_id',$student);
        $prf = $estd->getProfile;
        $prf->phone = $request->phone;
        $prf->email = $request->email;
        $prf->image = "sdfsfs"; //$request->image;
        $prf->dateOfBirth = $request->DOB;
        $prf->save();
        return redirect(route("admin.manageStudents"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($student) {
        $dstd = Student::findOrFail($student);
        $dstd->delete($dstd);
        return redirect(route("admin.manageStudents"));
    }
}
