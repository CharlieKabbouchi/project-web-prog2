<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassTController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SParentController;
use App\Http\Controllers\StudentController;
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



Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/admin/view/profile/{id}', [AdminController::class, 'viewprofile'])->name('viewprofile');
Route::get('/admin/edit/profile/{id}', [AdminController::class, 'editprofile'])->name('editprofile');
Route::get('/admin/manage/departments', [AdminController::class, 'manageDepartments'])->name('admin.manageDepartments');
Route::get('/admin/manage/semesters', [AdminController::class, 'manageSemesters'])->name('admin.manageSemesters');
Route::get('/admin/manage/classes', [AdminController::class, 'manageClasses'])->name('admin.manageClasses');
Route::get('/admin/manage/courses', [AdminController::class, 'manageCourses'])->name('admin.manageCourses');
Route::get('/admin/manage/students', [AdminController::class, 'manageStudents'])->name('admin.manageStudents');
Route::get('/admin/manage/teachers', [AdminController::class, 'manageTeachers'])->name('admin.manageTeachers');
Route::get('/admin/manage/parents', [AdminController::class, 'manageParents'])->name('admin.manageParents');
Route::get('/admin/manage/alumnis', [AdminController::class, 'manageAlumnis'])->name('admin.manageAlumnis');
Route::get('/admin/manage/admins', [AdminController::class, 'manageAdmins'])->name('admin.manageAdmins');

Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard1');
Route::get('/dashboard/manage/departments', [AdminController::class, 'ManageDepartments'])->name('admin.managedepartments');
Route::get('/dashboard/manage/semesters', [AdminController::class, 'ManageSemesters'])->name('admin.managesemesters');
Route::get('/dashboard/manage/courses', [AdminController::class, 'ManageCourses'])->name('admin.managecourses');
Route::get('/dashboard/manage/classes', [AdminController::class, 'ManageClasses'])->name('admin.manageclasses');
Route::get('/dashboard/manage/teachers', [AdminController::class, 'ManageTeachers'])->name('admin.manageteachers');
Route::get('/dashboard/manage/students', [AdminController::class, 'ManageStudents'])->name('admin.managestudents');
Route::get('/dashboard/manage/alumnis', [AdminController::class, 'ManageAlumnis'])->name('admin.manageAlumnis');
Route::get('/dashboard/manage/parents', [AdminController::class, 'ManageParents'])->name('admin.manageParent');
Route::get('/dashboard/view/profile', [AdminController::class, 'ViewProfile'])->name('admin.viewprofile');
Route::get('/dashboard/edit/profile', [AdminController::class, 'EditProfile'])->name('admin.editprofile');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
  

    Route::middleware(['auth.admin'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Admin Dashboard';
        // })->name('admin.dashboard');
        //Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
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

// Logout route
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
