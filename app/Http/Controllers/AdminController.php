<?php

namespace App\Http\Controllers;
use ConsoleTVs\Charts\Facades\Charts;
use App\Http\Controllers\DepartmentController;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Alumni;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */

     public function manageDepartments(Request $request)
     {
        $deps=Department::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/managedepartments',compact('deps','admin'));
     }

     public function manageSemesters(Request $request)
     {
        $sems=Semester::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/managesemesters',compact('sems','admin'));
     }

     public function viewDepartment($id)
     {
        return redirect()->route('department.show', ['department' => $id]);
      
    
     }
     public function viewSemester($id)
     {
        return redirect()->route('semester.show', ['semester' => $id]);
      
    
     } 
     
     public function editDepartment($id)
     {
        return redirect()->route('department.edit', ['department' => $id]);
       
    
     }
     

     
    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function Logout() {
        auth()->guard('admin')->logout();
        return redirect('/');
    }
    

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $request->session()->put('admin_id', $admin->id);
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function viewprofile1($id) {
//
    }
    public function editprofile1($id) {
        //
           
    }
    public function updateprofile($profile) {
        //
           
    }

    public function showDashboard(Request $request) {
       // $admin = Admin::find(session('admin_id'));


       $departmentCount = Department::count();
       $studentCount = Student::count();
       $teacherCount = Teacher::count();
       $alumniCount = Alumni::count();
        // Fetch data from the databasi
        $enrollmentData = Student::selectRaw('SUBSTRING(id, 2, 4) as enrollment_year, COUNT(*) as total')
            ->groupBy('enrollment_year')
            ->orderBy('enrollment_year')
            ->get();

        // Extract labels and values from the fetched data
        $labels = $enrollmentData->pluck('enrollment_year')->toArray();
        $values = $enrollmentData->pluck('total')->toArray();
      
 
    $studentsByDepartment = Student::join('departments', 'students.department_id', '=', 'departments.id')
    ->select('departments.name as department_name')
    ->selectRaw('COUNT(*) as total_students')
    ->groupBy('departments.name')
    ->get();

    $deps = $studentsByDepartment->pluck('department_name')->toArray();
    $stdnumber = $studentsByDepartment->pluck('total_students')->toArray();
        // Create a chart instance
   
    
         $adminId = $request->session()->get('admin_id');
         $adminId = session('admin_id');
         $admin = Auth::guard('admin')->user();
      
        return view('admin.dashboard', compact('admin', 'departmentCount', 'studentCount', 'teacherCount', 'alumniCount', 'labels','values','deps','stdnumber'));
    }

    public function EditProfile() {
        //return view('auth.admin-register');
    }
    public function ViewProfile() {
        //return view('auth.admin-register');
    }

    public function ManageCourses() {
        //return view('auth.admin-register');
    }
    public function ManageClasses() {
        //return view('auth.admin-register');
    }
    public function ManageTeachers() {
        //return view('auth.admin-register');
    }
    public function ManageStudents() {
        //return view('auth.admin-register');
    }
    public function ManageParents() {
        //return view('auth.admin-register');
    }
    public function ManageAlumnis() {
        //return view('auth.admin-register');
    }

    public function showRegistrationForm() {
        return view('auth.admin-register');
    }

    public function register(Request $request) {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'salary' => 'required|integer',
            // 'email' => 'required|string|email|max:255|unique:admins',
            // 'password' => 'required|string|min:8',
        ]);

        $admin = Admin::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'gender' => $request->input('gender'),
            'salary' => $request->input('salary'),
            // 'email' => $request->input('email'),
            // 'password' => Hash::make($request->input('password')),

        ]);
        return redirect()->route('admin.dashboard');
    }

    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('auth.admin-register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin) {
        //
    }
}
