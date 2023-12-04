<?php

namespace App\Http\Controllers;

use App\Models\ReviewC;
use App\Models\Student;
use App\Models\ClassT;
use Illuminate\Http\Request;

class ReviewCController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review=ReviewC::all();
        return redirect()->intended('/reviewC/allreviews')->with('review', $review);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student=Student::all();
        $classt=ClassT::all();
        return redirect()->intended('/reviewC/addreview')->with('student', $student)->with('classt',$classt);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['description'=>'required|min:4|max:100','rating'=>'required|numeric|between:1,10','student_id'=> 'required','classt_id'=> 'required',]);

        $nreview=new ReviewC();
        $nreview->description=$request->description;
        $nreview->rating=$request->rating;
        $nreview->student_id=$request->student_id;
        $nreview->classt_id=$request->classt_id;
        $nreview->save();  
        return redirect(route("reviewC.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(ReviewC $reviewC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewC $reviewC)
    {
        $ereview=ReviewC::findOrFail($reviewC);
        return redirect()->intended('/reviewC/editreview')->with('review', $ereview);; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewC $reviewC)
    {
        $request->validate(['description'=>'required|min:4|max:100','rating'=>'required|numeric|between:1,10','student_id'=> 'required','classt_id'=> 'required',]);

        $ereview=ReviewC::findOrFail($reviewC);
        $ereview->description=$request->description;
        $ereview->rating=$request->rating;
        $ereview->student_id=$request->student_id;
        $ereview->classt_id=$request->classt_id;
        $ereview->save();  
        return redirect(route("reviewC.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewC $reviewC)
    {
        $dreview=ReviewC::findOrFail($reviewC);
        $dreview->delete($dreview);
        return redirect(route("reviewC.index")); 
    }
}
