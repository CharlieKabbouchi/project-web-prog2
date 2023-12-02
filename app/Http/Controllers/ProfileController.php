<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Alumni;
use App\Models\Profile;
use App\Models\SParent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles=Profile::all();
        return redirect()->intended('/profile/allprofiles')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins=Admin::all();
        $teachers=Teacher::all();
        $students=Student::all();
        $parents=SParent::all();
        $alumnis=Alumni::all();

        return redirect()->intended('/profile/addprofile')
        ->with('admins', $admins)
        ->with('teachers', $teachers)
        ->with('students', $students)
        ->with('parents',$parents)
        ->with('alumnis', $alumnis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'image' => 'required|string',
            'dateOfBirth' => 'required|date',
            'alumni_id' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
            'sparent_id' => 'required',
            'admin_id' => 'required',
        ]);

        $profile = new Profile();
        $profile->phone = $request->phone;
        $profile->image = $request->image;
        $profile->dateOfBirth = $request->dateOfBirth;
        $profile->alumni_id = $request->alumni_id;
        $profile->teacher_id = $request->teacher_id;
        $profile->student_id = $request->student_id;
        $profile->sparent_id = $request->sparent_id;
        $profile->admin_id = $request->admin_id;
        $profile->save();

        return redirect(route('profile.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $eprofile=Profile::findOrFail($profile);
        return redirect()->intended('/profile/editprofile')->with('profile', $eprofile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'image' => 'required|string',
            'dateOfBirth' => 'required|date',
            'alumni_id' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
            'sparent_id' => 'required',
            'admin_id' => 'required',
        ]);

        $pf=Profile::findOrFail($profile);
        $pf->phone = $request->phone;
        $pf->image = $request->image;
        $pf->dateOfBirth = $request->dateOfBirth;
        $pf->alumni_id = $request->alumni_id;
        $pf->teacher_id = $request->teacher_id;
        $pf->student_id = $request->student_id;
        $pf->sparent_id = $request->sparent_id;
        $pf->admin_id = $request->admin_id;
        $pf->save();

        return redirect(route('profile.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect(route("profile.index"));
    }
}
