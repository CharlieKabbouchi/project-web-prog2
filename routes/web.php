<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassTController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SParentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileManagement;
use App\Http\Controllers\LoginSignUp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseManagement;

Route::get('upload', [FirebaseManagement::class, 'showForm']);
Route::post('/uploadd', [FirebaseManagement::class, 'upload']);
Route::get('/download/{filename}', [FirebaseManagement::class, 'download']);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/login',[LoginSignUp::class,'showLoginForm'])->name('login');
Route::post('/login/validate',[LoginSignUp::class,'login'])->name('loginValidation');
Route::get('/signup',[LoginSignUp::class,'showSignUpForm'])->name('signup');
Route::post('/signup/create',[LoginSignUp::class,'signup'])->name('signupCreation');
// Route::get('/login-signup/register', [AuthController::class, 'register'])->name('register');
// Route::post('/login-signup/register', [AuthController::class, 'registerPost'])->name('register');
// Route::get('/login-signup/login', [AuthController::class, 'login'])->name('login');
// Route::post('/login-signup/login', [AuthController::class, 'loginPost'])->name('login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/class_ts/create', [ClassTController::class, 'create'])->name('class_ts.create');
Route::post('/class_ts', [ClassTController::class, 'store'])->name('class_ts.store');
Route::get('/class_ts', [ClassTController::class, 'index'])->name('class_ts.index');
Route::get('/class_ts/show', [ClassTController::class, 'show'])->name('class_ts.show');
Route::get('/class_ts/{class_t}/edit', [ClassTController::class, 'edit'])->name('class_ts.edit');
Route::put('/class_ts/{class_t}', [ClassTController::class, 'update'])->name('class_ts.update');
Route::delete('/class_ts/{class_t}', [ClassTController::class, 'destroy'])->name('class_ts.destroy');



//Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');


Route::post('/logout',[AdminController::class, 'Logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
  

    Route::middleware(['auth.admin'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Admin Dashboard';
        // })->name('admin.dashboard');
       
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/view/profile/{id}', [AdminController::class, 'viewprofile'])->name('viewprofile');
        Route::get('/add/department}', [AdminController::class, 'addDepartment'])->name('addDepartment');
        Route::get('/add/Semester}', [AdminController::class, 'addSemester'])->name('addSemester');
        Route::get('/edit/profile/{id}', [AdminController::class, 'editprofile'])->name('editprofile');
       
        Route::get('/manage/departments', [AdminController::class, 'manageDepartments'])->name('admin.manageDepartments');
        Route::get('/manage/department/admin/edit/{id}', [AdminController::class, 'editDepartment'])->name('admin.editdepartment');
        Route::get('/manage/department/view/{department}', [DepartmentController::class, 'show'])->name('department.show');
        Route::get('/manage/department/edit/{department}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::put('/manage/department/update/{department}', [DepartmentController::class, 'update'])->name('department.update');
        Route::get('/manage/department/admin/view/{id}', [AdminController::class, 'viewDepartment'])->name('admin.viewdepartment');
       
        Route::get('/manage/semesters', [AdminController::class, 'manageSemesters'])->name('admin.manageSemesters');
        Route::get('/manage/semester/admin/edit/{id}', [AdminController::class, 'editsemester'])->name('admin.editsemester');
        Route::get('/manage/semester/view/{semester}', [SemesterController::class, 'show'])->name('semester.show');
        Route::get('/manage/semester/edit/{semester}', [SemesterController::class, 'edit'])->name('semester.edit');
        Route::put('/manage/semester/update/{semester}', [SemesterController::class, 'update'])->name('semester.update');
        Route::get('/manage/semester/admin/view/{id}', [AdminController::class, 'viewSemester'])->name('admin.viewsemester');
        


        Route::get('/manage/classes', [AdminController::class, 'manageClasses'])->name('admin.manageClasses');
        Route::get('/manage/courses', [AdminController::class, 'manageCourses'])->name('admin.manageCourses');
        Route::get('/manage/students', [AdminController::class, 'manageStudents'])->name('admin.manageStudents');
        Route::get('/manage/teachers', [AdminController::class, 'manageTeachers'])->name('admin.manageTeachers');
        Route::get('/manage/parents', [AdminController::class, 'manageParents'])->name('admin.manageParents');
        Route::get('/manage/alumnis', [AdminController::class, 'manageAlumnis'])->name('admin.manageAlumnis');
        Route::get('/manage/admins', [AdminController::class, 'manageAdmins'])->name('admin.manageAdmins');
        Route::get('/register', [AdminController::class, 'create'])->name('admin.register');
        Route::post('/register', [AdminController::class, 'register']);
        Route::get('/alumni/register', [AlumniController::class, 'create'])->name('alumni.create');
        Route::post('/alumni/register', [AlumniController::class, 'store']);
        // Route::get('/dashboard/{id}', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        // Add other admin routes here
    });
});

// Student Routes
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentController::class, 'login']);

    Route::middleware(['auth.student'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Student Dashboard';
        // })->name('student.dashboard');
        Route::get('/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
        // Add other student routes here
    });
});

// Parent Routes
Route::prefix('parent')->group(function () {
    Route::get('/login', [SParentController::class, 'showLoginForm'])->name('parent.login');
    Route::post('/login', [SParentController::class, 'login']);

    Route::middleware(['auth.parent'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Parent Dashboard';
        // })->name('parent.dashboard');

        Route::get('/dashboard', [SParentController::class, 'showDashboard'])->name('parent.dashboard');

        // Add other parent routes here
    });
});

// Alumni Routes
Route::prefix('alumni')->group(function () {
    Route::get('/login', [AlumniController::class, 'showLoginForm'])->name('alumni.login');
    Route::post('/login', [AlumniController::class, 'login']);

    Route::middleware(['auth.alumni'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Alumni Dashboard';
        // })->name('alumni.dashboard');
        Route::get('/dashboard', [AlumniController::class, 'showDashboard'])->name('alumni.dashboard');
        // Add other alumni routes here
    });
});

// Teacher Routes
Route::resource('teacher', TeacherController::class);
Route::get('/teacherDashboard', [TeacherController::class, 'showDashboard'])->name('teacherDashboard');
Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherController::class, 'login']);

    Route::middleware(['auth.teacher'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Teacher Dashboard';
        // })->name('teacher.dashboard');
        Route::get('/dashboard', [TeacherController::class, 'showDashboard'])->name('teacher.dashboard');
        // Add other teacher routes here
    });
});