<?php

namespace App\Http\Controllers;

use App\Models\StudentClassT;
use App\Models\Student;
use App\Models\ClassT;
use App\Models\Profile;
use Illuminate\Http\Request;

class StudentClassTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stct=StudentClassT::all();
        return redirect()->intended('/studentclasst/allstudentclasst')->with('stct', $stct);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students=Student::all();
        $classt=ClassT::all();

        return redirect()->intended('/studentclasst/addstudentclasst')
        ->with('students',$students)
        ->with('classt', $classt);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'nullable|string',
            'classt_id' => 'nullable|exists:class_t_s,id',
            'attendence' => 'required|integer',
            'averageGrade' => 'required|numeric',
            'quizGrade' => 'nullable|numeric',
            'projectGrade' => 'nullable|numeric',
            'assignmentGrade' => 'nullable|numeric',
        ]);

        $studentClassT = new StudentClassT();
        $studentClassT->student_id = $request->student_id;
        $studentClassT->classt_id = $request->classt_id;
        $studentClassT->attendence = $request->attendence;
        $studentClassT->averageGrade = $request->averageGrade;
        $studentClassT->quizGrade = $request->quizGrade;
        $studentClassT->projectGrade = $request->projectGrade;
        $studentClassT->assignmentGrade = $request->assignmentGrade;
        $studentClassT->save();

        return redirect(route('student_class_ts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentClassT $studentClassT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClassT $studentClassT)
    {
        $estct=Profile::findOrFail($studentClassT);
        return redirect()->intended('/studentclasst/editstudentclasst')->with('studentclasst', $estct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentClassT $studentClassT)
    {
        $request->validate([
            'student_id' => 'nullable|string',
            'classt_id' => 'nullable|exists:class_t_s,id',
            'attendence' => 'required|integer',
            'averageGrade' => 'required|numeric',
            'quizGrade' => 'nullable|numeric',
            'projectGrade' => 'nullable|numeric',
            'assignmentGrade' => 'nullable|numeric',
        ]);

        $stct=StudentClassT::findOrFail($studentClassT);
        $stct= new StudentClassT();
        $stct->student_id = $request->student_id;
        $stct->classt_id = $request->classt_id;
        $stct->attendence = $request->attendence;
        $stct->averageGrade = $request->averageGrade;
        $stct->quizGrade = $request->quizGrade;
        $stct->projectGrade = $request->projectGrade;
        $stct->assignmentGrade = $request->assignmentGrade;
        $stct->save();

        return redirect(route('student_class_ts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClassT $studentClassT)
    {
        $studentClassT->delete();
        return redirect(route("student_class_ts.index"));
    }
}
