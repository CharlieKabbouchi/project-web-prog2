<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $deps=Department::all();
        return redirect()->intended('/department/alldepartments')->with('deps', $deps);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->intended('/department/add-department');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:2|max:40','location'=>'required|min:10','totalCredits'=>'required',]);
        $ndep=new Department();
        $ndep->name=$request->name;
        $ndep->location=$request->location;
        $ndep->totalCredits=$request->totalCredits;   
        $ndep->save();  
        return redirect(route("department.index")); 


    }

    /**
     * Display the specified resource.
     */
    public function show($department)
    {
        $vdep=Department::findOrFail($department);
        return redirect()->intended('/department/editdepartment')->with('vdep',$vdep);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $department)
    {
        $edep=Department::findOrFail($department);
        return redirect()->intended('/department/viewdepartment')->with('edep',$edep);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$department)
    {
        $request->validate(['name'=>'required|min:2|max:40','location'=>'required|min:10','totalCredits'=>'required',]);
        $edep=Department::findOrFail($departmentID);
        $ndep->name=$request->name;
        $ndep->location=$request->location;
        $ndep->totalCredits=$request->totalCredits;   
        $ndep->save();  
        return redirect(route("department.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department)
    {
        $ddep=Department::findOrFail($department);
        $ddep->delete();
        return redirect(route("department.index")); 
    }
}
