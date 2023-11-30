<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.alumni-login');
    }

    public function showDashboard(Request $request) {
         
        $alumni = Alumni::find(session('alumni_id'));
        // $alumniId = session('alumni_id');
        // $alumni = Auth::guard('alumni')->user();
        // dd($alumni);
        return view('alumni.dashboard', compact('alumni'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('alumni')->attempt($credentials)) {
            $alumni = Auth::guard('alumni')->user();
            $request->session()->put('alumni_id', $alumni->id);
            return redirect()->intended('/alumni/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }
    public function index()
    {
        $alumnis=Alumni::all();
        return redirect()->intended('/alumni/allalumnis');
        
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

    public function insertAlumni($studentId)
    {
        $nalumni=new Alumni();
        $nalumni->graduationYear=date('Y');
        $student=Student::findOrFail($studentId);
        $nalumni->student_id=$student->id;
        $nalumni->password=$student->password;
        $nalumni->email=$student->email;
        $nalumni->save();  
        return redirect(route("alumni.index")); 
    } 
    public function store(Request $request)
    {
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumuni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumuni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumuni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alumuni)
    {
        $dalumni=Alumni::findOrFail($alumuni);
        $dalumni->delete();
    }
}
