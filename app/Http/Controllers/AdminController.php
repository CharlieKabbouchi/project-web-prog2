<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */

    public function showLoginForm() {
        return view('auth.admin-login');
    }


    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $request->session()->put('admin_id', $admin->id);
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function showDashboard(Request $request) {

        $adminId = $request->session()->get('admin_id');
        // $adminId = session('admin_id');
        // $admin = Auth::guard('admin')->user();
        // dd($admin);
        return view('admin.dashboard', compact('adminId'));
    }

    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
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
