<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sems=Semester::all();
        return redirect()->intended('/semester/allsemesters')->with('sems', $sems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('semester.addSemester',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'yearBelongsTo' => [
                'required',
                Rule::unique('semesters')->where(function ($query) use ($request) {
                    return $query->where('type', $request->input('type'));
                }),
            ],
            'startingDate' => 'required|date',
            'endingDate' => 'required|date|after:startingDate',
            'type' => 'required',
        ], ['endingDate.after' => 'The Ending Date must be a date after the Starting Date.']);
        
        $nsem = new Semester();
        $nsem->type = $request->type;
        $nsem->startingDate = $request->startingDate;
        $nsem->endingDate = $request->endingDate;
        $nsem->yearBelongsTo = $request->yearBelongsTo;
        $nsem->save();
        return redirect(route("admin.manageSemesters")); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$semester)
    {

        $semester=Semester::findOrFail($semester);
        
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        $courseNumbers = $semester->getCourse()->count();
        $classNumbers = $semester->getClassT()->count();
        $studentNumbers =$semester->getClassT()
        ->join('student_class_t_s', 'class_t_s.id', '=', 'student_class_t_s.classt_id')
        ->distinct('student_class_t_s.student_id')
        ->count();
    
        return view('semester.viewSemester', compact('semester', 'classNumbers', 'courseNumbers', 'studentNumbers','admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$semester)
    {
        $semester=Semester::findOrFail($semester);
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('semester.editSemester', compact('semester','admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $semester)
    {
        $request->validate([
            'yearBelongsTo' => [
                'required',
                Rule::unique('semesters')->where(function ($query) use ($request) {
                    return $query->where('type', $request->input('type'));
                }),
            ],
            'startingDate' => 'required|date',
            'endingDate' => 'required|date|after:startingDate',
            'type' => 'required',
        ], ['endingDate.after' => 'The Ending Date must be a date after the Starting Date.']);
        $esem=Semester::findOrFail($semester);
        $esem->type = $request->type;
        $esem->startingDate = $request->startingDate;
        $esem->endingDate = $request->endingDate;
        $esem->yearBelongsTo = $request->yearBelongsTo;
        $esem->save();
        return redirect(route("admin.manageSemesters")); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($semester)
    {
        $dsem=Semester::findOrFail($semester);
        $dsem->delete();
        return redirect(route("admin.manageSemesters")); 
    }
}
