<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassTController;
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



Route::get('/login', [LoginSignUp::class, 'showLoginForm'])->name('login');
Route::post('/login/validate', [LoginSignUp::class, 'login'])->name('loginValidation');
Route::get('/signup', [LoginSignUp::class, 'showSignUpForm'])->name('signup');
Route::post('/signup/create', [LoginSignUp::class, 'signup'])->name('signupCreation');
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


Route::post('/logout', [AdminController::class, 'Logout'])->name('logout');

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

        Route::get('/edit/profile/{id}', [AdminController::class, 'editprofile'])->name('editprofile');
        
        //Departments
        Route::get('/manage/departments', [AdminController::class, 'manageDepartments'])->name('admin.manageDepartments');
        Route::get('/manage/departments/view/{department}', [AdminController::class, 'viewDepartments'])->name('admin.viewDepartment');
        Route::get('/manage/departments/modify/{department}', [AdminController::class, 'editDepartments'])->name('admin.editDepartment');
        Route::get('/manage/departments/add', [AdminController::class, 'addDepartments'])->name('admin.addDepartment');//
        Route::get('/manage/departments/create', [DepartmentController::class, 'create'])->name('admin.createdepartment');
        Route::post('/manage/departments/store', [DepartmentController::class, 'store'])->name('admin.storedepartment');
        Route::get('/manage/departments/show/{department}', [DepartmentController::class, 'show'])->name('admin.showDepartment');
        Route::get('/manage/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('admin.editdepartment');
        Route::put('/manage/departments/update/{department}', [DepartmentController::class, 'update'])->name('admin.updatedepartment');
        Route::post('/manage/departments/delete/{department}', [DepartmentController::class, 'destroy'])->name('admin.deleteDepartment'); 

        //Semesters
        Route::get('/manage/semesters', [AdminController::class, 'manageSemesters'])->name('admin.manageSemesters');
        Route::get('/manage/semesters/view/{semester}', [AdminController::class, 'viewSemesters'])->name('admin.viewSemester');
        Route::get('/manage/semesters/modify/{semester}', [AdminController::class, 'editSemesters'])->name('admin.editSemester');
        Route::get('/manage/semesters/add', [AdminController::class, 'addSemesters'])->name('admin.addSemesters');//
        Route::get('/manage/semesters/create', [SemesterController::class, 'create'])->name('admin.createsemester');
        Route::post('/manage/semesters/store', [SemesterController::class, 'store'])->name('admin.storesemester');
        Route::get('/manage/semesters/show/{semester}', [SemesterController::class, 'show'])->name('admin.showSemester');
        Route::get('/manage/semesters/edit/{semester}', [SemesterController::class, 'edit'])->name('admin.editsemester');
        Route::put('/manage/semesters/update/{semester}', [SemesterController::class, 'update'])->name('admin.updatesemester');
        Route::post('/manage/semesters/delete/{semester}', [SemesterController::class, 'destroy'])->name('admin.deleteSemester');

        


        Route::get('/manage/departments/store', [DepartmentController::class, 'store'])->name('admin.storeDepartment');

        Route::get('/manage/classes', [AdminController::class, 'manageClasses'])->name('admin.manageClasses');
        Route::get('/manage/courses', [AdminController::class, 'manageCourses'])->name('admin.manageCourses');
        Route::get('/manage/students', [AdminController::class, 'manageStudents'])->name('admin.manageStudents');
        Route::get('/manage/teachers', [AdminController::class, 'manageTeachers'])->name('admin.manageTeachers');
        Route::get('/manage/parents', [AdminController::class, 'manageParents'])->name('admin.manageParents');
        Route::get('/manage/alumnis', [AdminController::class, 'manageAlumnis'])->name('admin.manageAlumnis');

        Route::get('/manages', [AdminController::class, 'manageAdmins'])->name('admin.manageAdmins');

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
        Route::post('/logout', [AlumniController::class, 'LogoutAlumni'])->name('alumni.logout');

        Route::get('/manage/Events', [AlumniController::class, 'manageEvents'])->name('alumni.manageEvents');
        Route::get('/manage/Events/edit/{event}', [AlumniController::class, 'showEdit'])->name('alumni.editEvent');
        Route::get('/manage/Events/create', [AlumniController::class, 'createEvent'])->name('alumni.createEvent');
        Route::post('/manage/Events/create', [AlumniController::class, 'storeEvent'])->name('alumni.storeEvent');
        Route::post('/manage/Events/edit/{event}', [AlumniController::class, 'updateEvent'])->name('alumni.updateEvent');
        Route::post('/manage/Events/{event}', [AlumniController::class, 'deleteEvent'])->name('alumni.deleteEvent');
        Route::get('/manage/Q&A', [AlumniController::class, 'manageQA'])->name('alumni.manageQ&A');
        Route::post('/submitAnswer/{questionId}', [AlumniController::class, 'submitAnswer'])->name('alumni.submitAnswer');
        Route::get('/manage/Calendar', [AlumniController::class, 'viewCalendar'])->name('alumni.viewCalendar');

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

// Route::post('/logout', function(){
//     auth()->guard('admin')->logout();
//     auth()->guard('alumni')->logout();
//     auth()->guard('student')->logout();
//     auth()->guard('teacher')->logout();
//     auth()->guard('parent')->logout();
//     return redirect('/');
// });
