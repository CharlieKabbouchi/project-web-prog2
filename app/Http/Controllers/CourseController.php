<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\DepartmentCourse;
use App\Models\Semester;
use App\Models\SemesterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CourseController extends Controller
{
    
     
    public function index()
    {
        // Your logic for displaying courses
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('course.addCourse', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:2|max:40', 'credits' => 'required|integer']);
        $ncourse = new Course();
        $ncourse->name = $request->name;
        $ncourse->credits = $request->credits;
        $ncourse->save();
        return redirect(route("admin.manageCourses"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $studentNumbers = $course->getClassT()
        ->join('student_class_t_s', 'class_t_s.id', '=', 'student_class_t_s.classt_id')
        ->distinct('student_class_t_s.student_id')
        ->count();
$teachers= Teacher::join('class_t_s', 'teachers.id', '=', 'class_t_s.teacher_id')
->where('class_t_s.course_id', $course->id)
->distinct('teachers.id')->get();
$numberTeachers=$teachers->count();

$departments=Department::join('department_courses', 'departments.id', '=', 'department_courses.department_id')
->where('department_courses.course_id', $course->id)
->distinct('departments.id')
->get();
$numberDeps=$departments->count();

        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('course.viewCourse', compact('course', 'admin','studentNumbers','numberTeachers','departments','numberDeps','teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        $departments=Department::all();
        $semesters=Semester::all();
        return view('course.editCourse', compact('course', 'admin','departments','semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|min:2|max:40', 'credits' => 'required|integer']);
        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->credits = $request->credits;
        $pivot = new DepartmentCourse ();
        $pivot->course_id = $course->id;
        $pivot->department_id = $request->department;
        $pivot->save();
        $pivot=new SemesterCourse();
        $pivot->course_id = $course->id;
        $pivot->semester_id = $request->department;
        $pivot->save();
        $course->save();
        return redirect(route("admin.manageCourses"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect(route("admin.manageCourses"));
    }
}
