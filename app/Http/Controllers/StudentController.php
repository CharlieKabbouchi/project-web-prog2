<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SParent;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function showDashboard(Request $request) {
         
        $student = Student::find(session('student_id'));
        // $studentId = $request->session()->get('student_id');
        // $studentId = session('student_id');
        // $student = Auth::guard('student')->user();
        // dd($alumni);
        return view('student.dashboard', compact('student'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $request->session()->put('student_id', $student->id);
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }


    //Management
    public function index()
    {
        $stds=Student::all();
        return redirect()->intended('/student/allstudents')->with('stds', $stds);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents=SParent::all();
        $deps=Department::all();
        return redirect()->intended('/student/addstudent')->with('deps', $deps)->with('parents',$parents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','sparent_id'=> 'required','department_id'=> 'required',]);

        
        $nstd=new Student();
        $nstd->firstname=$request->firstname;
        $nstd->lastname=$request->lastname;
        $nstd->Gender=$request->Gender;
        $nstd->$sparent_id=$request->sparent_id;
        $nstd->department_id=$request->department_id;
        $nstd->save();  
        return redirect(route("student.index")); 
    }

    /**
     * Display the specified resource.
     */
    public function show($student)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $student)
    {
        $estd=Student::findOrFail($student);
        return redirect()->intended('/student/editstudent'); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate(['firstname'=>'required|min:2|max:15','lastname'=>'required|min:2|max:15','Gender'=>'required','sparent_id'=> 'required','department_id'=> 'required',]);

        
        $estd=Student::findOrFail($student);
        $estd->firstname=$request->firstname;
        $estd->lastname=$request->lastname;
        $estd->Gender=$request->Gender;
        $estd->$sparent_id=$request->sparent_id;
        $estd->department_id=$request->department_id;
        $estd->save();  
        return redirect(route("student.index")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $dstd=Student::findOrFail($student);
        $dstd->delete($dstd);
        return redirect(route("student.index")); 
    }
}
