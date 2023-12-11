<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassTController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileManagement;
use App\Http\Controllers\LoginSignUp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseManagement;
use App\Models\Semester;

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
        //Route::get('/student/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
        Route::get('/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
        Route::get('/manage/events', [StudentController::class, 'manageEvent'])->name('student.manageevents');
        Route::get('/manage/class', [StudentController::class, 'manageClass'])->name('student.manageclass');
        Route::get('/manage/Q&A', [StudentController::class, 'manageQandA'])->name('student.manageQ&A');
        Route::get('/manage/calendar', [StudentController::class, 'manageCalendar'])->name('student.viewCalendar');
        Route::get('/view/profile/{id}', [StudentController::class, 'viewProfile'])->name('viewprofile');
        Route::get('/edit/profile/{id}', [StudentController::class, 'editProfile'])->name('editprofile');
        Route::get('/view/class/{id}', [StudentController::class, 'viewClass'])->name('viewclass');
        Route::get('/view/resource/{id}', [StudentController::class, 'viewResource'])->name('viewresource');
        Route::get('/view/assignment/{id}', [StudentController::class, 'viewAssignment'])->name('viewassignment');
        Route::get('/view/submission/{id}', [StudentController::class, 'viewSubmission'])->name('viewsubmission');
        Route::get('/add/submission/{id}', [StudentController::class, 'addSubmission'])->name('addsubmission');
        Route::get('/enroll/class/', [StudentController::class, 'enrollClass'])->name('enrollClass');
        Route::get('/enroll/event/', [StudentController::class, 'enrollEvent'])->name('enrollEvent');
        Route::get('/add/reviewc/', [StudentController::class, 'addReviewc'])->name('addReviewc');
        Route::get('/view/event/', [StudentController::class, 'viewEvent'])->name('viewEvent');
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
        Route::get('/ShowClasses', [SParentController::class, 'show'])->name('parent.ShowClasses');

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