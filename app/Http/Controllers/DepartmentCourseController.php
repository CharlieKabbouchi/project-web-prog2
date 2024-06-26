<?php

namespace App\Http\Controllers;

use App\Models\DepartmentCourse;
use Illuminate\Http\Request;

class DepartmentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(DepartmentCourse $departmentCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentCourse $departmentCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepartmentCourse $departmentCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentCourse $departmentCourse)
    {
        //
    }

    public function storeRecord($courseID,$departID)
    {
       
        $ncd=new DepartmentCourse();
        $ncd->department_id=$departID;
        $ncd->course_id=$courseID;
        $ncd->save();

    }

    public function deleteRecord($courseID,$departID)
    {
        
        $dcd=DepartmentCourse::where('department_id',$departID)->where('course_id',$courseID)->firstOrFail();
        $dcd->delete();

    }

    
}
