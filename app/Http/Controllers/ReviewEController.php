<?php

namespace App\Http\Controllers;

use App\Models\ReviewE;
use App\Models\Student;
use App\Models\Event;
use Illuminate\Http\Request;

class ReviewEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review=ReviewE::all();
        return redirect()->intended('/reviewE/allreviews')->with('review', $review);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student=Student::all();
        $event=Event::all();
        return redirect()->intended('/reviewE/addreview')->with('student', $student)->with('event',$event);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['description'=>'required|min:4|max:100','rating'=>'required|numeric|between:1,10','student_id'=> 'required','event_id'=> 'required',]);

        $nreview=new ReviewE();
        $nreview->description=$request->description;
        $nreview->rating=$request->rating;
        $nreview->student_id=$request->student_id;
        $nreview->event_id=$request->event_id;
        $nreview->save();  
        return redirect(route("reviewE.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(ReviewE $reviewE)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewE $reviewE)
    {
        $ereview=ReviewE::findOrFail($reviewE);
        return redirect()->intended('/reviewE/editreview')->with('review', $ereview);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewE $reviewE)
    {
        $request->validate(['description'=>'required|min:4|max:100','rating'=>'required|numeric|between:1,10','student_id'=> 'required','classt_id'=> 'required',]);

        $ereview=ReviewE::findOrFail($reviewE);
        $ereview->description=$request->description;
        $ereview->rating=$request->rating;
        $ereview->student_id=$request->student_id;
        $ereview->event_id=$request->event_id;
        $ereview->save();  
        return redirect(route("reviewE.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewE $reviewE)
    {
        $dreview=ReviewE::findOrFail($reviewE);
        $dreview->delete($dreview);
        return redirect(route("reviewE.index")); 
    }
}
