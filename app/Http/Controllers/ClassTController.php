<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\Semester;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassT;

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

    public function store(Request $request)
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
        $class->DayofWeek = "Thursday";
        $class->starttime = $request->starttime;
        $class->endtime = $request->endtime;
        $class->teacher_id= $request->teacher;
        $class->semester_id= $request->semester;
        $class->course_id= $request->course;
        // $class->getCourse->attach($request->course);
        // $class->getSemester->attach($request->semester);
        $class->abscence=6;
        $class->save();

        return redirect(route('admin.manageClasses'));
    }

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
            'dayOfWeek' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'startingDate'=>'required',
            'endingDate'=>'required',
            'teacher' => 'required|exists:teachers,id',
            'course' => 'required|exists:courses,id',
            'semester' => 'required|exists:semesters,id',
        ]);

        $class = ClassT::findOrFail($id);
        $class->dayOfWeek = $request->dayOfWeek;
        $class->starttime = $request->starttime;
        $class->endtime = $request->endtime;
        $class->startingDate = $request->startingDate;
        $class->endingDate = $request->endingDate;
     
        $class->getTeacher->attach($request->teacher);
        $class->getCourse->attach($request->course);
        $class->getSemester->attach($request->semester);

        $class->save();

        return redirect(route('admin.manageClasses'));
    }

    public function destroy($id)
    {
        $class = ClassT::findOrFail($id);
        $class->delete();

        return redirect(route('admin.manageClasses'));
    }
}
