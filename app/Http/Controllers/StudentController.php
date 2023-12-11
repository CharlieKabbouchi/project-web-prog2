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

    public function manageEvent()
    {
        return view('student.manageevents');
    }

    public function manageClass()
    {
        return view('student.manageclass');
    }

    public function manageQandA()
    {
        return view('student.manageQ&A');
    }

    public function manageCalendar()
    {
        return view('student.manageCalendar');
    }

    public function viewProfile()
    {
        //
    }

    public function editProfile()
    {
        //
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
  
    public function showDashboard(Request $request) {
        
        $student = Student::find(session('student_id'));
        $studentId = $request->session()->get('student_id');
        $studentId = session('student_id');
        $student = Auth::guard('student')->user();
        //dd($alumni);

        foreach ($students as $student) {
            $classes[$student->id] = $student->getClassT()->with(['getCourse', 'getCourse'])->withPivot('averageGrade')->get() ?? [];
        }

        $studentData = [];
    
        foreach ($students as $student) {
            $totalClassesTaken = count($classes[$student->id]);
            $totalWeightedGrade = 0;
            $totalCredits = 0;
    
            foreach ($classes[$student->id] as $class) {
                $totalWeightedGrade += $class->pivot->averageGrade * $class->getCourse->credits;
                $totalCredits += $class->getCourse->credits;
            }
    
            $gpa = ($totalCredits > 0) ? $totalWeightedGrade / $totalCredits : 0;
            $remainingCredits = $totalCredits - $totalCreditsTaken;
            $studentData[] = [
                'totalCreditsTaken' => $student->totalCreditsTaken,
                'totalCredits' => $student->getDepartment->totalCredits,
                'totalClassesTaken' => $totalClassesTaken,
                'gpa' => $gpa,
                'remainingCredits' => $remainingCredits,
                // 'classes' => $classes[$student->id],
            ];
        }

        return view('parent.dashboard', compact('student', 'studentData'));
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
        $nstd->s_parent_id=$request->sparent_id;
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
        $estd->sparent_id=$request->sparent_id;
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
