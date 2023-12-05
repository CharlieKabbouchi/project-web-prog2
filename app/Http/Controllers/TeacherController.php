<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller {
    /**
     * Display a listing of the resource.
     */
    // public function showLoginForm() {
    //     return view('auth.teacher-login');
    // }
    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('teacher')->attempt($credentials)) {
    //         $teacher = Auth::guard('teacher')->user();
    //         $request->session()->put('teacher_id', $teacher->id);
    //         return redirect()->intended('/teacher/dashboard');
    //     }

    //     return back()->withErrors(['error' => 'Invalid login credentials']);
    // }
   

    public function showDashboard(Request $request) {

        $teacher = Teacher::find(session('teacher_id'));
        // $teacherId = $request->session()->get('teacher_id');
        // $teacherId = session('teacher_id');
        // $teacher = Auth::guard('teacher')->user();
        // dd($alumni);
        return view('teacher.dashboard', compact('teacher'));
    }

    

    public function index() {
        $teacher = Teacher::all();
        return redirect()->intended('/teacher/allteachers')->with('teacher', $teacher);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return redirect()->intended('/teacher/addteacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
         $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
        ]);

        $te = new Teacher();
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();

        return redirect(route('teacher.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher) {
        $te=Teacher::findOrFail($teacher);
        return redirect()->intended('/teacher/editteacher')->with('teacher', $te);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'salary' => 'required|integer',
        ]);
    
        $te=Teacher::findOrFail($teacher);
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
        $te->salary = $request->salary;
        $te->save();

        return redirect(route('teacher.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher) {
        $teacher->delete();
        return redirect(route("teacher.index")); 
    }
}
