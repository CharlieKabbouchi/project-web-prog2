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
<<<<<<< Updated upstream
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

         //Courses
         Route::get('/manage/courses', [AdminController::class, 'manageCourses'])->name('admin.manageCourses');
         Route::get('/manage/courses/view/{course}', [AdminController::class, 'viewCourses'])->name('admin.viewCourse');
         Route::get('/manage/courses/modify/{course}', [AdminController::class, 'editCourses'])->name('admin.editCourse');
         Route::get('/manage/courses/add', [AdminController::class, 'addCourses'])->name('admin.addCourse');//
         Route::get('/manage/courses/create', [CourseController::class, 'create'])->name('admin.createcourse');
         Route::post('/manage/courses/store', [CourseController::class, 'store'])->name('admin.storeCourse');
         Route::get('/manage/courses/show/{course}', [CourseController::class, 'show'])->name('admin.showCourse');
         Route::get('/manage/courses/edit/{course}', [CourseController::class, 'edit'])->name('admin.editcourse');
         Route::put('/manage/courses/update/{course}', [CourseController::class, 'update'])->name('admin.updateCourse');
         Route::post('/manage/courses/delete/{course}', [CourseController::class, 'destroy'])->name('admin.deleteCourse');

        //Classes
        Route::get('/manage/classes', [AdminController::class, 'manageClasses'])->name('admin.manageClasses');
        Route::get('/manage/classes/view/{class}', [AdminController::class, 'viewClasses'])->name('admin.viewClass');
        Route::get('/manage/classes/modify/{class}', [AdminController::class, 'editclasses'])->name('admin.editClass');
        Route::get('/manage/classes/add', [AdminController::class, 'addclasses'])->name('admin.addClass');//
        Route::get('/manage/classes/create', [ClassTController::class, 'create'])->name('admin.createclass');
        Route::post('/manage/classes/store', [ClassTController::class, 'store'])->name('admin.storeClass');
        Route::get('/manage/classes/show/{class}', [ClassTController::class, 'show'])->name('admin.showClass');
        Route::get('/manage/classes/edit/{class}', [ClassTController::class, 'edit'])->name('admin.editclass');
        Route::put('/manage/classes/update/{class}', [ClassTController::class, 'update'])->name('admin.updateClass');
        Route::post('/manage/classes/delete/{class}', [ClassTController::class, 'destroy'])->name('admin.deleteClass');



        Route::get('/manage/departments/store', [DepartmentController::class, 'store'])->name('admin.storeDepartment');
      
       
        Route::get('/manage/courses', [AdminController::class, 'manageCourses'])->name('admin.manageCourses');
        Route::get('/manage/students', [AdminController::class, 'manageStudents'])->name('admin.manageStudents');
        Route::get('/manage/teachers', [AdminController::class, 'manageTeachers'])->name('admin.manageTeachers');
        Route::get('/manage/parents', [AdminController::class, 'manageParents'])->name('admin.manageParents');
        Route::get('/manage/alumnis', [AdminController::class, 'manageAlumnis'])->name('admin.manageAlumnis');
        Route::get('/manages', [AdminController::class, 'manageAdmins'])->name('admin.manageAdmins');
=======
>>>>>>> Stashed changes
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