<?php

namespace App\Http\Controllers;

use App\Models\SParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.parent-login');
    }

    
    public function showDashboard(Request $request) {
         
        $parentId = $request->session()->get('parent_id');
        // $parentId = session('parent_id');
        // $parent = Auth::guard('parent')->user();
        // dd($alumni);
        return view('parent.dashboard', compact('parentId'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('parent')->attempt($credentials)) {
            $parent = Auth::guard('parent')->user();
            $request->session()->put('parent_id', $parent->id);
            return redirect()->intended('/parent/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SParent $sParent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SParent $sParent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SParent $sParent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SParent $sParent)
    {
        //
    }
}
