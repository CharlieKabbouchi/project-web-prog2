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
         
        $parent = SParent::find(session('parent_id'));
        // $parentId = session('parent_id');
        // $parent = Auth::guard('parent')->user();
        // dd($alumni);
        return view('parent.dashboard', compact('parent'));
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
        $parent=SParent::all();
        return redirect()->intended('/parent/allparent')->with('parent', $parent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->intended('/parent/addparent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'email' => 'required|email|unique:s_parents',
            'password' => 'required|string',
        ]);

        $sparent = new SParent();
        $sparent->firstName = $request->firstName;
        $sparent->lastName = $request->lastName;
        $sparent->Gender = $request->Gender;
        $sparent->email = $request->email;
        $sparent->password = bcrypt($request->password);
        $sparent->save();

        return redirect(route('sparent.index'));
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
        $sp=SParent::findOrFail($sparent);
        return redirect()->intended('/parent/editparent')->with('parent', $sp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SParent $sParent)
    {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            'email' => 'required|email|unique:s_parents,email,' . $sparent->id,
            'password' => 'nullable|string',
        ]);

        $sp=SParent::findOrFail($sparent);
        $sp->firstName = $request->firstName;
        $sp->lastName = $request->lastName;
        $sp->Gender = $request->Gender;
        $sp->email = $request->email;
        if ($request->has('password')) {
            $sparent->password = bcrypt($request->password);
        }
        $sp->save();
        return redirect(route('sparent.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SParent $sParent)
    {
        $sp=SParent::findOrFail($sparent);
        $sp->delete($sp);
        return redirect(route("sparent.index"));
    }
}
