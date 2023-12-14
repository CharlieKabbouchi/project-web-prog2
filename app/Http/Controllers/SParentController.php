<?php

namespace App\Http\Controllers;

use App\Models\ClassT;
use App\Models\SParent;
use App\Models\Pending;
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
    
    public function viewprofile()
    {
        $parent = SParent::find(session('parent_id'));        
        return view('parent.viewprofile',compact('parent'));
    }
    
    



    public function index() {
        $parent = SParent::all();
        return redirect()->intended('/parent/allparent')->with('parent', $parent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($wparent) {
        $admin = Auth::guard('admin')->user();
        $wparent=Pending::findOrFail($wparent);
        return view('parent.addParent', compact('admin','wparent'));
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
            // 'salary' => 'required|integer',
            'email' => 'required|email',
            //'image' => 'required|image',//link
           'phone'=>'required',
           'DOB' =>'required'
        ]);

        $te = new SParent();
        $te->firstName = $request->firstName;
        $te->lastName = $request->lastName;
        $te->Gender = $request->Gender;
       //$te->salary = $request->salary;
        $te->save();
        $pending=Pending::where('email',$request->email)->where('phone',$request->phone);
        $pending->delete();
        $prf=new Profile();
        $prf->phone=$request->phone;
        $prf->email=$request->email;
        $prf->image="NO IMAGE";
        $prf->dateOfBirth=$request->DOB;
        $prf->s_parent_id=$te->id;
        $prf->save();
        return redirect(route("admin.manageParents"));
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
        // dd( $prf);

        $admin = Auth::guard('admin')->user();
        return view('parent.editParent')->with('parent', $sp)->with('admin',$admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $parent) {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'Gender' => 'required|string',
        ]);

        $sp = SParent::findOrFail($parent);
        $sp->firstName = $request->firstName;
        $sp->lastName = $request->lastName;
        $sp->Gender = $request->Gender;
        $prf=$sp->getProfile;
    $prf->phone=$request->phone;
    $prf->email=$request->email;
    $prf->dateOfBirth=$request->DOB;
    $prf->save();
   
        $sp->save();
        return redirect(route('admin.manageParents'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SParent $sParent) {
        $sParent->delete();
        return redirect(route("sparent.index"));
    }
}
