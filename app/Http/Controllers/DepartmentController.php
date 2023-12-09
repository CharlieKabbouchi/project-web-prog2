<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $deps=Department::all();
        return redirect()->intended('/department/alldepartments')->with('deps', $deps);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->intended('/department/add-department');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:2|max:40','location'=>'required|min:10','totalCredits'=>'required',]);
        $ndep=new Department();
        $ndep->name=$request->name;
        $ndep->location=$request->location;
        $ndep->totalCredits=$request->totalCredits;   
        $ndep->save();  
        return redirect(route("department.index")); 


    }

    /**
     * Display the specified resource.
     */

    
    public function show(Request $request,$department)
    {
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        $department = Department::findOrFail($department);
        $StudentCount = $department->getStudent()->count();
        $CourseCount = $department->getCourse()->count();
        $TeacherCount = $department->getCourse()->join('class_t_s', 'class_t_s.course_id', '=', 'courses.id')
            ->join('teachers', 'teachers.id', '=', 'class_t_s.teacher_id')
            ->distinct('teachers.id')
            ->count();
            return view('department.viewdepartment', compact('admin','department', 'TeacherCount', 'CourseCount', 'StudentCount'));
 
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
        return view('department.editdepartment')->with('department',$department)->with('admin',$admin);
    }

    /**
     * Update the specified resource in storage.
     */

     public function updatef(Request $request,$department)
     {
        
         $request->validate(['name'=>'required|min:2|max:40','location'=>'required|min:10','totalCredits'=>'required',]);
         $edep=Department::findOrFail($department);
         dd( $edep);
         $edep->name=$request->name;
         $edep->location=$request->location;
         $edep->totalCredits=$request->totalCredits;   
         $edep->save();  
         return redirect(route("admin.manageDepartments"));
     } 
    public function update(Request $request,$department)
    {
       
        $request->validate(['name'=>'required|min:2|max:40','location'=>'required|min:10','totalCredits'=>'required',]);
        $edep=Department::findOrFail($department);
        $edep->name=$request->name;
        $edep->location=$request->location;
        $edep->totalCredits=$request->totalCredits;   
        $edep->save();  
        return redirect(route("admin.manageDepartments"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department)
    {
        $ddep=Department::findOrFail($department);
        $ddep->delete();
        return redirect(route("department.index")); 
    }
}
