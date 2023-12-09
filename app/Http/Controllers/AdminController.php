<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */

  
    //  public function showLoginForm() {
    //     return view('auth.admin-login');
    // }



    // public function login(Request $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         $admin = Auth::guard('admin')->user();
    //         $request->session()->put('admin_id', $admin->id);
    //         return redirect()->intended('/admin/dashboard');
    //     }

    //     return back()->withErrors(['error' => 'Invalid login credentials']);
    // }

    public function viewprofile1($id) {
//
    }
    public function editprofile1($id) {
        //
           
    }
    public function updateprofile($profile) {
        //
           
    }

    public function showDashboard(Request $request) {
       // $admin = Admin::find(session('admin_id'));
       $admin=null;
        // $adminId = $request->session()->get('admin_id');
        // $adminId = session('admin_id');
        // $admin = Auth::guard('admin')->user();
        // dd($admin);
    
        return view('admin.dashboard', compact('admin'));
    }


    public function EditProfile() {
        //return view('auth.admin-register');
    }
    public function ViewProfile() {
        //return view('auth.admin-register');
    }
    public function ManageDepartments() {
        //return view('auth.admin-register');
    }
    public function ManageSemesters() {
        //return view('auth.admin-register');
    }
    public function ManageCourses() {
        //return view('auth.admin-register');
    }
    public function ManageClasses() {
        //return view('auth.admin-register');
    }
    public function ManageTeachers() {
        //return view('auth.admin-register');
    }
    public function ManageStudents() {
        //return view('auth.admin-register');
    }
    public function ManageParents() {
        //return view('auth.admin-register');
    }
    public function ManageAlumnis() {
        //return view('auth.admin-register');
    }

    public function showRegistrationForm() {
        return view('auth.admin-register');
    }
  

    public function register(Request $request) {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'salary' => 'required|integer',
            // 'email' => 'required|string|email|max:255|unique:admins',
            // 'password' => 'required|string|min:8',
        ]);

        $admin = Admin::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'gender' => $request->input('gender'),
            'salary' => $request->input('salary'),
            // 'email' => $request->input('email'),
            // 'password' => Hash::make($request->input('password')),

        ]);
        return redirect()->route('admin.dashboard');
    }

    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('auth.admin-register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin) {
        //
    }
}
