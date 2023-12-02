<?php

namespace App\Http\Controllers;

use App\Models\SemesterCourse;
use Illuminate\Http\Request;

class SemesterCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SemesterCourse $semesterCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SemesterCourse $semesterCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SemesterCourse $semesterCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SemesterCourse $semesterCourse)
    {
        //
    }

    public function storeRecord($courseID,$semesterID)
    {
       
        $ncs=new SemesterCourse();
        $ncs->semester_id=$semesterID;
        $ncs->course_id=$courseID;
        $ncs->save();

    }

    public function deleteRecord($courseID,$semesterID)
    {
        
        $dcs=DepartmentCourse::where('semester_id',$semesterID)->where('course_id',$courseID)->firstOrFail();
        $dcs->delete();

    }
}
