<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller {
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware('admin')->except(['showLoginForm', 'login', 'showDashboard']);
        $this->middleware('auth.teacher')->only(['showDashboard']);
    }

    public function showLoginForm() {
        return view('auth.teacher-login');
    }

    public function showDashboard(Request $request) {

        $teacherId = $request->session()->get('teacher_id');
        // $teacherId = session('teacher_id');
        // $teacher = Auth::guard('teacher')->user();
        // dd($alumni);
        return view('teacher.dashboard', compact('teacherId'));
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            $teacher = Auth::guard('teacher')->user();
            $request->session()->put('teacher_id', $teacher->id);
            return redirect()->intended('/teacher/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function index() {
        $teachers = Teacher::all();
        return view('teacher.list', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'Gender' => 'required',
            'salary' => 'required|integer',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required',
        ]);

        $teacher = Teacher::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'Gender' => $request->input('Gender'),
            'salary' => $request->input('salary'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 'approved',
        ]);
        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher) {
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher) {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher) {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'Gender' => 'required',
            'salary' => 'required|integer',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'required',
        ]);

        $status = $request->input('status') ?? ($request->has('approve') ? 'approved' : 'rejected');

        $teacher->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'Gender' => $request->input('Gender'),
            'salary' => $request->input('salary'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 'approved',
        ]);
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher) {
        $teacher->delete();
        return redirect()->route('teachers.index');
    }
}
