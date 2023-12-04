<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course=Course::all();
        return redirect()->intended('/course/allcourses')->with('course', $course);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->intended('/course/addcourse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:5|max:50','credits'=>'required|in:1,3',]);

        $ncourse=new Course();
        $ncourse->name=$request->name;
        $ncourse->credits=$request->credits;
        $ncourse->save();  
        return redirect(route("course.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $ecourse=Course::findOrFail($course);
        return redirect()->intended('/course/editcourse')->with('course', $ecourse);;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate(['name'=>'required|min:5|max:50','credits'=>'required|in:1,3',]);

        $ecourse=Course::findOrFail($course);
        $ecourse->name=$request->name;
        $ecourse->credits=$request->credits;
        $ecourse->save();  
        return redirect(route("course.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $dcourse=Course::findOrFail($course);
        $dcourse->delete($dcourse);
        return redirect(route("course.index")); 
    }
}
