<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;



use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use ConsoleTVs\Charts\Facades\Charts;
use App\Http\Controllers\DepartmentController;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Alumni;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\SParent;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Pending;
use App\Models\Profile;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */


    public function manageDepartments(Request $request) {
        $deps = Department::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/managedepartments', compact('deps', 'admin'));
    }

    public function manageCourses(Request $request) {
        $courses = Course::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/managecourses', compact('courses', 'admin'));
    }

    public function manageTeachers(Request $request) {
        $teachers = Teacher::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        $pteachersn = Pending::where('type', 'teacher')->count();
        return view('/admin/manageteacher', compact('teachers', 'admin', 'pteachersn'));
    }
    public function manageStudents(Request $request) {
        $students = Student::all();
        $admin = Auth::guard('admin')->user();
        $pstudentsn = Pending::where('type', 'student')->count();
        return view('/admin/managestudent', compact('students', 'admin', 'pstudentsn'));
    }

    public function manageParents(Request $request) {
        $parents = SParent::all();
        $admin = Auth::guard('admin')->user();
        $pparentsn = Pending::where('type', 'parent')->count();
        return view('/admin/manageparent', compact('parents', 'admin', 'pparentsn'));
    }
    public function managealumnis(Request $request) {

        $admin = Auth::guard('admin')->user();
        $students = Student::all();
        foreach ($students as $student) {
            $classes = [];
            $classes[$student->id] = $student->getClassT()->with(['getCourse'])->withPivot('averageGrade')->get() ?? [];
            $totalCredits = 0;

            foreach ($classes[$student->id] as $class) {
                if ($class->pivot->averageGrade >= 60) {
                    $totalCredits += $class->getCourse->credits;
                }
            }

            $totalCreditsShouldTaken = 0;
            $totalCreditsShouldTaken += $student->getDepartment->totalCredits;
            if ($totalCreditsShouldTaken <= $totalCredits && $student->isGraduated == false) {
            //    dd($student->getProfile);
                $student->isGraduated = true;
                $alumni = new Alumni();
                $alumni->graduationYear = date('Y');
                $alumni->student_id = $student->id;
                $alumni->save();
                $prf=new Profile();
                // dd($student->getProfile);
                $prf->dateOfBirth=$student->getProfile->dateOfBirth;
                $prf->image=$student->getProfile->image;
                $prf->phone=$student->getProfile->phone;
                $prf->email=$student->getProfile->email;
                $prf->alumni_id=$alumni->id;
                $prf->save();
                $student->save();
            }
        }
        $alumnis = Alumni::all();
        return view('admin.managealumni', compact('alumnis', 'admin', 'totalCreditsShouldTaken', 'totalCredits'));
    }

    public function editparents($parent) {

        return redirect(route("admin.editparents", ['parent' => $parent]));
    }

    public function viewStudents($student) {

        return redirect(route("admin.showStudent", ['student' => $student]));
    }
    public function viewTeachers($teacher) {

        return redirect(route("admin.showTeacher", ['teacher' => $teacher]));
    }
    public function viewPendingTeachers(Request $request) {
        $admin = Auth::guard('admin')->user();
        $pusers = Pending::where('type', 'teacher')->get();
        return view('/admin/viewpendingusers', compact('pusers', 'admin'));
    }
     
    public function viewPendingparents(Request $request) {

        $admin = Auth::guard('admin')->user();
        $pusers = Pending::where('type', 'parent')->get();
        return view('/admin/viewpendingusers', compact('pusers', 'admin'));
    }
    public function viewPendingStudents(Request $request) {

        $admin = Auth::guard('admin')->user();
        $pusers = Pending::where('type', 'student')->get();
        return view('/admin/viewpendingusers', compact('pusers', 'admin'));
    }
    public function addteachers($wteacher) {
        return redirect(route("admin.createteacher", ['wteacher' => $wteacher]));
    }
    public function addparents($wparent) {
        return redirect(route("admin.createparent", ['wparent' => $wparent]));
    } 
    public function addstudents($wstudent) {

        return redirect(route("admin.createstudent", ['wstudent' => $wstudent]));
    }

    public function viewDepartments($department) {


        return redirect(route("admin.showDepartment", ['department' => $department]));
    }
    public function editDepartments($department) {


        return redirect(route("admin.editdepartment", ['department' => $department]));
    }
    public function editCourses($course) {


        return redirect(route("admin.editcourse", ['course' => $course]));
    }
    public function editStudents($student) {

        return redirect(route("admin.editstudent", ['student' => $student]));
    }
    public function editTeachers($teacher) {


        return redirect(route("admin.editteacher", ['teacher' => $teacher]));
    }
    public function addDepartment() {


        return redirect(route("admin.createdepartment"));
    }
    public function viewSemesters($semester) {
        return redirect(route("admin.showSemester", ['semester' => $semester]));
    }
    public function   viewCourses($course) {
        return redirect(route("admin.showCourse", ['course' => $course]));
    }
    public function   viewClasses($class) {
        return redirect(route("admin.showClass", ['class' => $class]));
    }
    public function editSemesters($semester) {

        return redirect(route("admin.editsemester", ['semester' => $semester]));
    }

    public function editclasses($class) {


        return redirect(route("admin.editclass", ['class' => $class]));
    }
    public function addSemesters() {


        return redirect(route("admin.createsemester"));
    }

    public function addCourses() {


        return redirect(route("admin.createcourse"));
    }

    public function addclasses() {


        return redirect(route("admin.createclass"));
    }


    public function manageClasses(Request $request) {
        $classes = ClassT::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/manageclasses', compact('classes', 'admin'));
    }
    public function manageSemesters(Request $request) {
        $sems = Semester::all();
        $adminId = $request->session()->get('admin_id');
        $adminId = session('admin_id');
        $admin = Auth::guard('admin')->user();
        return view('/admin/managesemesters', compact('sems', 'admin'));
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



    public function viewprofile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.viewprofile',compact('admin'));

    }
    
    public function editprofile($id) {
        $admin = Auth::guard('admin')->user();
        return view('admin.editprofile', compact('admin'));
    }
    public function updateProfile(Request $request, $id) {
        $admin = Auth::guard('admin')->user();
        $adminId = session('admin_id');
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dateOfBirth' => 'nullable|date',
        ]);

    
        $profile = Profile::where('admin_id', $admin->id)->first();

        // Update the profile information
        $profile->phone = $request->input('phone');
        $profile->email = $request->input('email');
        $profile->dateOfBirth = $request->input('dateOfBirth');

        // Handle profile image upload to Firebase Storage
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileContents = file_get_contents($image->getPathname());
            $imageName = $adminId . '.' . $image->getClientOriginalExtension();
            $filePath = 'admin-images/' . $imageName;

            // Laravel Storage operations
            $laravelDisk = Storage::disk('gcs');

            // Upload the image using Laravel Storage
            $laravelDisk->put($filePath, $fileContents);

            // Check if the uploaded image exists
            $exists = $laravelDisk->exists($filePath);

            // Get the last modified time of the uploaded image
            $time = $laravelDisk->lastModified($filePath);

            // Firebase Storage operations
            $firebaseStorage = Firebase::storage();
            $firebaseBucket = $firebaseStorage->getBucket();

            // Upload the image to Firebase Storage
            $firebaseObject = $firebaseBucket->upload($fileContents, [
                'name' => $filePath,
            ]);
            // Get the public URL of the uploaded image from Firebase
            $firebaseImageUrl = $firebaseObject->signedUrl(new \DateTime('9999-12-31T23:59:59.999999Z'));

            // Save the Firebase image URL to the profile
            $profile->image = $firebaseImageUrl;
            // dd($firebaseImageUrl);
        }

        $profile->save();

        return view('admin.viewprofile', compact('admin'));
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

        return view('admin.dashboard', compact('admin', 'departmentCount', 'studentCount', 'teacherCount', 'alumniCount', 'labels', 'values', 'deps', 'stdnumber'));
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

    public function viewAlumni($alumniID) {
        $admin = Auth::guard('admin')->user();
        $alumni = Alumni::find($alumniID);

        $events = $alumni->getEvent;
        // dd($events);

        return view('admin.viewAlumni', compact('admin', 'alumni', 'events'));
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
