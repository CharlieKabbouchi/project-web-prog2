<?php

namespace App\Http\Controllers;

use App\Models\ClassT;
use App\Models\SParent;
use App\Models\Student;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SParentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm() {
        return view('auth.parent-login');
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


    public function showDashboard(Request $request) {
        $parent = SParent::find(session('parent_id'));
    

        $students = $parent->getStudent;
        $classes = [];
    
        foreach ($students as $student) {
            $classes[$student->id] = $student->getClassT()->with(['getCourse'])->withPivot('averageGrade')->get() ?? [];
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
    
            $studentData[] = [
                'name' => $student->firstName . ' ' . $student->lastName,
                'totalCreditsTaken' => $student->totalCreditsTaken,
                'totalCredits' => $student->getDepartment->totalCredits,
                'totalClassesTaken' => $totalClassesTaken,
                'gpa' => $gpa,
                'classes' => $classes[$student->id],
            ];
        }

        return view('parent.dashboard', compact('parent', 'studentData', 'classes'));
    }
    
    
    
    



    public function index() {
        $parent = SParent::all();
        return redirect()->intended('/parent/allparent')->with('parent', $parent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return redirect()->intended('/parent/addparent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
        ]);

        $sparent = new SParent();
        $sparent->firstName = $request->firstName;
        $sparent->lastName = $request->lastName;
        $sparent->Gender = $request->Gender;
        $sparent->save();

        return redirect(route('sparent.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SParent $sParent) {
        $parent = SParent::find(session('parent_id'));
        $students = $parent->getStudent;
        $classes = [];
    
        foreach ($students as $student) {
            $classes[$student->id] = $student->getClassT()->withPivot('averageGrade', 'quizGrade', 'projectGrade', 'assignmentGrade')->get() ?? [];
        }
    
        return view('parent.ShowClasses', compact('parent', 'students', 'classes'));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $parent) {
        $sp = SParent::findOrFail($parent);
    
        $prf=Profile::where('s_parent_id',$sp->id);
        dd( $prf);

        $admin = Auth::guard('admin')->user();
        return view('parent.editParent')->with('wparent', $sp)->with('admin',$admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SParent $sParent) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
        ]);

        $sp = SParent::findOrFail($sParent);
        $sp->firstName = $request->firstName;
        $sp->lastName = $request->lastName;
        $sp->Gender = $request->Gender;
        $sp->save();
        return redirect(route('sparent.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SParent $sParent) {
        $sParent->delete();
        return redirect(route("sparent.index"));
    }
}
