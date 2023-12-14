<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\StudentClassT;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ReviewC;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\Semester;
use App\Models\Submission;
use App\Models\SemesterCourse;
use App\Models\ClassT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Your logic for displaying classes
    }

    public function create(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $teachers = Teacher::all();
        $courses = Course::all();
        $semesters = Semester::all();

        return view('class.addClass', compact('admin', 'teachers', 'courses', 'semesters'));
    }


    // public function store(Request $request)
    // {
    //     $sclass = ClassT::findOrFail($class);

    //     $teacherInfo = Teacher::whereHas('getClassT', function ($query) use ($class) {
    //         $query->where('id', $class);
    //     })->first();
        
    //     $averageGrade = StudentClassT::where('classt_id', $class)
    //         ->avg('averageGrade');
    
    //     $students = Student::whereHas('getClassT', function ($query) use ($class) {
    //         $query->where('id', $class);
    //     })->get();
        
    //     $reviews = ReviewC::where('classt_id', $class)->get();
              
    //     $admin = Auth::guard('admin')->user();
    //     return view('class.viewClass', compact('sclass', 'admin', 'teacherInfo', 'averageGrade', 'students','reviews'));
       
    // }

    public function edit(Request $request, $id)
    {
        $class = ClassT::findOrFail($id);
        $admin = Auth::guard('admin')->user();
        $teachers = Teacher::all();
        $courses = Course::all();
        $semesters = Semester::all();

        return view('class.editClass', compact('class', 'admin', 'teachers', 'courses', 'semesters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'startingDate'=>'required',
            'endingDate'=>'required',
            'Day' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'teacher' => 'required',
            'course' => 'required',
            'semester' => 'required',
            'abscence' => 'required',
        ]);
              

        $class = ClassT::findOrFail($id);
        $class->DayOfWeek = $request->Day;
        $class->starttime = $request->starttime;
        $class->endtime = $request->endtime;
        $class->startingDate = $request->startingDate;
        $class->endingDate = $request->endingDate;
     
        $class->teacher_id= $request->teacher;
        $class->semester_id= $request->semester;
        $class->course_id= $request->course;
       
        $class->abscence=$request->abscence;

        $class->save();

        return redirect(route('admin.manageClasses'));
    }
    public function store(Request $request)
    {
        // $request->validate([

        //     'startingDate'=>'required',
        //     'endingDate'=>'required',
        //     'Day' => 'required',
        //     'starttime' => 'required',
        //     'endtime' => 'required',
        //     'teacher' => 'required',
        //     'course' => 'required',
        //     'semester' => 'required',
        //     'abscence' => 'required',
        // ]);
              

        $class = new ClassT();
        $class->DayOfWeek = $request->Day;
        $class->starttime = $request->starttime;
        $class->endtime = $request->endtime;
        $class->startingDate = $request->startingDate;
        $class->endingDate = $request->endingDate;
     
        $class->teacher_id= $request->teacher;
        $class->semester_id= $request->semester;
        $class->course_id= $request->course;
       
        $class->abscence=$request->abscence;

        $class->save();

        return redirect(route('admin.manageClasses'));
    }

    public function destroy($id)
    {
        $class = ClassT::findOrFail($id);
        $class->delete();

        return redirect(route('admin.manageClasses'));
    }

    public function createT(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $classes = $teacher->getClassT()
        ->with('getCourse', 'getSemester')
        ->get();
        $semesters = $classes->pluck('getSemester')->unique();
        $courses = $classes->pluck('getCourse')->unique(); 
        return view('teacher.addClass', compact('teacher','courses','semesters'));
    }

    public function storeT(Request $request)
    {
       
        // $request->validate([

        //     'startingDate'=>'required',
        //     'endingDate'=>'required',
        //     'dayOfWeek' => 'required',
        //     'starttime' => 'required',
        //     'endtime' => 'required',
        //     'teacher' => 'required|exists:teachers,id',
        //     'course' => 'required|exists:courses,id',
        //     'semester' => 'required|exists:semesters,id',
        // ]);
        $class = new ClassT();
        $class->startingDate = $request->startingDate;
        $class->endingDate = $request->endingDate;
        $class->DayofWeek = $request->DayofWeek;
        $class->starttime = $request->starttime;
        $class->endtime = $request->endtime;
        $class->teacher_id= $request->teacher;
        $class->semester_id= $request->semester;
        $class->course_id= $request->course;
        // $class->getCourse->attach($request->course);
        // $class->getSemester->attach($request->semester);
        $class->abscence=6;
        $class->save();

        return redirect(route('teacher.manageClasses'));
    }

    public function showT($class_id)
    {
        $teacher = Auth::guard('teacher')->user();

        $class = ClassT::with([
            'getStudents',
            'getReviewC',
            'getAssignment',
            'getSemester',
            'getCourse',
        ])->where('id', $class_id)
            ->where('teacher_id', $teacher->id)
            ->first();
    
        if (!$class) {
            return abort(404);
        }
    
        // Convert dates to Carbon instances
        // $class->startingDate = Carbon::parse($class->startingDate);
        // $class->endingDate = Carbon::parse($class->endingDate);
        // Format date and time for display
        // $formattedStartDate = $class->startingDate->format('Y-m-d');
        // $formattedEndDate = $class->endingDate->format('Y-m-d');
        // $resources = $class->getUploadResource;
        // $reviews = $class->getReviewC;
        // $assignments = $class->getAssignment;
        // $calendar = $class->getCalendar;

        $semester = $class->getSemester;
        $course = $class->getCourse;
        $classInfo = $class->toArray();
        $students = $class->getStudents->toArray();
        return view('teacher.viewclass', compact('teacher', 'classInfo', 'students','course','semester','class'));
    }
}
