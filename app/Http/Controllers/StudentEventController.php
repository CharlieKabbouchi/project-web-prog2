<?php

namespace App\Http\Controllers;

use App\Models\StudentEvent;
use Illuminate\Http\Request;

class StudentEventController extends Controller
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
    public function show(StudentEvent $studentEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentEvent $studentEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentEvent $studentEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentEvent $studentEvent)
    {
        //
    }

    public function unregisterEventStudent($studentId,$eventId)
    {
        $ures=StudentEvent::where('event_id',$eventId)->where('student_id',$studentId)->firstOrFail();
        $ures->delete();
    }   

    public function registerEventStudent($studentId,$eventId)
    {
        $res=new StudentEvent();
        $res->event_id=$eventId;
        $res->student_id=$studentId;
        $res->save();

        }
}
