<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Alumni;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event=Event::all();
        return redirect()->intended('/event/allevent')->with('event', $event);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumni=Alumni::all();
        return redirect()->intended('/event/addevent')->with('alumni', $alumni);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['description'=>'required|min:4|max:100','title'=>'required|min:5|max:20','type'=>'required|min:5|max:20','time'=> 'required','alumni_id'=> 'required',]);

        $nevent=new Event();
        $nevent->description=$request->description;
        $nevent->title=$request->title;
        $nevent->type=$request->type;
        $nevent->time=$request->time;
        $nevent->alumni_id=$request->alumni_id;
        $nevent->save();  
        return redirect(route("event.index"));

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $eevent=Event::findOrFail($event);
        return redirect()->intended('/event/editevent')->with('event', $eevent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate(['description'=>'required|min:4|max:100','title'=>'required|min:5|max:20','type'=>'required|min:5|max:20','time'=> 'required','alumni_id'=> 'required',]);

        $eevent=Event::findOrFail($event);
        $eevent->description=$request->description;
        $eevent->title=$request->title;
        $eevent->type=$request->type;
        $eevent->time=$request->time;
        $eevent->alumni_id=$request->alumni_id;
        $eevent->save();  
        return redirect(route("event.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $devent=Event::findOrFail($event);
        $devent->delete($devent);
        return redirect(route("event.index")); 
    }
}
