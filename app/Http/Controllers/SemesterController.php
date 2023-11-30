<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sems=Semester::all();
        return redirect()->intended('/semester/allsemesters')->with('sems', $sems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->intended('/semester/add-semester');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([ 'yearBelongsTo' => [
            'required',
            Rule::unique('semesters')->where(function ($query) use ($request) {
                return $query->where('type', $request->input('type'));
            }),
        ],'startingDate' => 'required|date','endingDate' => 'required|date|after:startingDate','type'=>'required',],['endingDate.after' => 'The Ending Date must be a date after the Starting Date.',]);
        $nsem=new Semester();
        $nsem->type=$request->type;
        $nsem->startingDate=$request->startingDate;
        $nsem->endingDate=$request->endingDate;
        $nsem->yearBelongsTo=$request->yearBelongsTo;
        $nsem->save();  
        return redirect(route("semester.index")); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($semester)
    {
        $esem=Semester::findOrFail($semester);
        return redirect()->intended('/semester/editsemester');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $semester)
    {
        $request->validate([ 'yearBelongsTo' => [
            'required',
            Rule::unique('semesters')->where(function ($query) use ($request) {
                return $query->where('type', $request->input('type'));
            }),
        ],'startingDate' => 'required|date','endingDate' => 'required|date|after:startingDate','type'=>'required',],['endingDate.after' => 'The Ending Date must be a date after the Starting Date.',]);
        $esem=Semester::findOrFail($semester);
        $esem->type=$request->type;
        $esem->startingDate=$request->startingDate;
        $esem->endingDate=$request->endingDate;
        $esem->yearBelongsTo=$request->yearBelongsTo;
        $esem->save();  
        return redirect(route("semester.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($semester)
    {
        $dsem=Semester::all($semester);
        $dsem->delete();
        return redirect(route("semester.index")); 
    }
}
