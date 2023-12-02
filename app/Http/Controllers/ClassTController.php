<?php

namespace App\Http\Controllers;

use App\Models\ClassT;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassTController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $classes = ClassT::with(['getCourse', 'getSemester', 'getTeacher'])->get();
        return view('class_ts.index', compact('classes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $courses = Course::all();
        $semesters = Semester::all();
        $teachers = Teacher::all();

        return view('class_ts.create', compact('courses', 'semesters', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'startingDate' => 'required|date',
            'endingDate' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'abscence' => 'required|integer',
        ]);

        $class = new ClassT;
        $class->startingDate = $validatedData['startingDate'];
        $class->endingDate = $validatedData['endingDate'];
        $class->course_id = $validatedData['course_id'];
        $class->semester_id = $validatedData['semester_id'];
        $class->teacher_id = $validatedData['teacher_id'];
        $class->abscence = $validatedData['abscence'];

        $class->save();

        return redirect()->route('class_ts.index')->with('success', 'Class timetable created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show() {
        $classes = ClassT::with(['getCourse', 'getSemester', 'getTeacher'])->get();
        return view('class_ts.show', compact('classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassT $class_t) {
        $courses = Course::all();
        $semesters = Semester::all();
        $teachers = Teacher::all();

        return view('class_ts.edit', compact('class_t', 'courses', 'semesters', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassT $class_t) {
        $validatedData = $request->validate([
            'startingDate' => 'required|date',
            'endingDate' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'abscence' => 'required|integer',
        ]);

        $class_t->update([
            'startingDate' => $validatedData['startingDate'],
            'endingDate' => $validatedData['endingDate'],
            'course_id' => $validatedData['course_id'],
            'semester_id' => $validatedData['semester_id'],
            'teacher_id' => $validatedData['teacher_id'],
            'abscence' => $validatedData['abscence'],
        ]);

        return redirect()->route('class_ts.index')->with('success', 'Class timetable updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassT $class_t) {
        $class_t->delete();

        return redirect()->route('class_ts.index')->with('success', 'Class timetable deleted successfully!');
    }
}
