<?php

namespace App\Http\Controllers;
use App\Models\Pending;
use Illuminate\Http\Request;

class LoginSignUp extends Controller
{
    public function showLoginForm() {
        return view('login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $request->session()->put('admin_id', $admin->id);
            return redirect()->intended('/admin/dashboard');
        }

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $request->session()->put('student_id', $student->id);
            return redirect()->intended('/student/dashboard');
        }
        if (Auth::guard('teacher')->attempt($credentials)) {
            $teacher = Auth::guard('teacher')->user();
            $request->session()->put('teacher_id', $teacher->id);
            return redirect()->intended('/teacher/dashboard');
        }
        if (Auth::guard('parent')->attempt($credentials)) {
            $parent = Auth::guard('parent')->user();
            $request->session()->put('parent_id', $parent->id);
            return redirect()->intended('/parent/dashboard');
        }

         if (Auth::guard('alumni')->attempt($credentials)) {
            $alumni = Auth::guard('alumni')->user();
            $request->session()->put('alumni_id', $alumni->id);
            return redirect()->intended('/alumni/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }


    public function showSignUpForm ()
    {
        return view('SignUp');
    }

    public function signup (Request $request)
    {
        
            $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','type'=> 'required','email'=> 'unique:pendings|email','phone'=>'min:8|max:12','image'=>'required','type'=>'required','DOB'=>'required']);
            $nuser=new Pending();
            $nuser->firstName=$request->firstname;
            $nuser->lastName=$request->lastname;
            $nuser->Gender=$request->Gender;
            $nuser->type=$request->type;
            $nuser->email=$request->email;
            $nuser->phone=$request->phone;
            $nuser->DOB=$request->DOB;
            $proimg=time().'-'.$request->file('image')->getClientOriginalName();
            //onedrivestorage and get the link
            $nuser->image=link;
            $nuser->save();
            return redirect()->route('login');
            
    }

}