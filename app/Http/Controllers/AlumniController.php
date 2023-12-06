<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ReviewE;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller {
    /**
     * Display a listing of the resource.
     */

    // public function showLoginForm() {
    //     return view('auth.alumni-login');
    // }
    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('alumni')->attempt($credentials)) {
    //         $alumni = Auth::guard('alumni')->user();
    //         $request->session()->put('alumni_id', $alumni->id);
    //         return redirect()->intended('/alumni/dashboard');
    //     }

    //     return back()->withErrors(['error' => 'Invalid login credentials']);
    // }


    public function showDashboard(Request $request) {

        $alumni = Alumni::find(session('alumni_id'));
        // $alumniId = session('alumni_id');
        // $alumni = Auth::guard('alumni')->user();
        // dd($alumni);
        return view('alumni.dashboard', compact('alumni'));
    }


    public function index() {
        $alumnis = Alumni::all();
        return redirect()->intended('/alumni/allalumnis')->with('alumni', $alumnis);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $students = Student::all();
        return view('auth.alumni-register', compact('students'));
        // return redirect()->intended('/admin/alumni/register')->with('student', $student);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $nalumni = new Alumni();
        $nalumni->graduationYear = date('Y');
        $nalumni->student_id = $request->input('student_id');

        // $students = Student::findOrFail($request->input('student_id'));
        // $nalumni->password = $student->password;
        // $nalumni->email = $student->email;

        $nalumni->save();

        return redirect(route("alumni.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni) {
        $ealumni = Alumni::findOrFail($alumni);
        return redirect()->intended('/alumni/editalumni')->with('alumni', $ealumni);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumuni) {
        $request->validate(['graduationYear' => 'required', 'student_id' => 'required',]);

        $ealumni = ReviewE::findOrFail($alumuni);
        $ealumni->graduationYear = date('Y');
        // $ealumni->email = $request->email;
        $ealumni->student_id = $request->student_id;
        // $ealumni->password = $request->password;
        $ealumni->save();
        return redirect(route("alumni.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni, $alumniId) {
        $dalumni = Alumni::findOrFail($alumniId);
        $dalumni->delete();
        $alumni->delete();
        return redirect(route("alumni.index"));
    }
}
