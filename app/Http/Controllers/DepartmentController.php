<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('department.addDepartment', compact('admin'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:2|max:40','location'=>'required','totalCredits'=>'required',]);
        $ndep=new Department();
        $ndep->name=$request->name;
        $ndep->location=$request->location;
        $ndep->totalCredits=$request->totalCredits;   
        $ndep->save();  
        return redirect(route("admin.manageDepartments")); 
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
{
        $department = Department::findOrFail($id);
        $studentNumbers = $department->getStudent()->count();
        $courseNumbers = $department->getCourse()->count();
        $teacherNumbers = $department->getCourse()->join('class_t_s', 'class_t_s.course_id', '=', 'courses.id')
        ->join('teachers', 'teachers.id', '=', 'class_t_s.teacher_id')
        ->distinct('teachers.id')
        ->count();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
    
    return view('department.viewDepartment', compact('department', 'teacherNumbers', 'courseNumbers', 'studentNumbers','admin'));
}

public function update(Request $request,$department)
     {
        
         $request->validate(['name'=>'required|min:2|max:40','location'=>'required','totalCredits'=>'required',]);
         $edep=Department::findOrFail($department);
         $edep->name=$request->name;
         $edep->location=$request->location;
         $edep->totalCredits=$request->totalCredits;   
         $edep->save();  
         return redirect(route("admin.manageDepartments"));
     } 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Request $request,$department)
    {
        $department=Department::findOrFail($department);
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('department.editDepartment', compact('department','admin'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department)
    {
        $ddep=Department::findOrFail($department);
        $ddep->delete();
        return redirect(route("admin.manageDepartments")); 
    }
}
