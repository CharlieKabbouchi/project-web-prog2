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
    public function showLoginForm() {
        return view('auth.alumni-login');
    }

    public function showDashboard(Request $request) {

        $alumni = Alumni::find(session('alumni_id'));
        // $alumniId = session('alumni_id');
        // $alumni = Auth::guard('alumni')->user();
        // dd($alumni);
        return view('alumni.dashboard', compact('alumni'));
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('alumni')->attempt($credentials)) {
            $alumni = Auth::guard('alumni')->user();
            $request->session()->put('alumni_id', $alumni->id);
            return redirect()->intended('/alumni/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }
    public function index() {
        $alumnis = Alumni::all();
        return redirect()->intended('/alumni/allalumnis')->with('alumni', $alumnis);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $student = Student::all();
        return redirect()->intended('/alumni/addalumni')->with('student', $student);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function insertAlumni($studentId) {
        $nalumni = new Alumni();
        $nalumni->graduationYear = date('Y');
        $student = Student::findOrFail($studentId);
        $nalumni->student_id = $student->id;
        $nalumni->password = $student->password;
        $nalumni->email = $student->email;
        $nalumni->save();
        return redirect(route("alumni.index"));
    }
    public function store(Request $request) {
        $request->validate(['graduationYear' => 'required', 'email' => 'required|unique', 'student_id' => 'required', 'password' => 'required',]);

        $nalumni = new Alumni();
        $nalumni->graduationYear = $request->graduationYear;
        $nalumni->email = $request->email;
        $nalumni->student_id = $request->student_id;
        $nalumni->password = $request->password;
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
        $request->validate(['graduationYear' => 'required', 'email' => 'required|unique', 'student_id' => 'required', 'password' => 'required',]);

        $ealumni = ReviewE::findOrFail($alumuni);
        $ealumni->graduationYear = $request->graduationYear;
        $ealumni->email = $request->email;
        $ealumni->student_id = $request->student_id;
        $ealumni->password = $request->password;
        $ealumni->save();
        return redirect(route("alumni.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alumni) {
        $dalumni = Alumni::findOrFail($alumni);
        $dalumni->delete($dalumni);
        return redirect(route("alumni.index"));
    }
}
