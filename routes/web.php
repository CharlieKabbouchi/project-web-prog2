<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClassTController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FirebaseController;
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
use App\Http\Controllers\PendingController;
use App\Models\Semester;
use App\Models\Teacher;

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

Route::get('/upload',  [FirebaseController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload-image',  [FirebaseController::class, 'uploadImage'])->name('upload.image');
Route::get('/image-gallery', [FirebaseController::class, 'showImageGallery']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/login',[LoginSignUp::class,'showLoginForm'])->name('login');
Route::post('/login/validate',[LoginSignUp::class,'login'])->name('loginValidation');
Route::get('/signup',[LoginSignUp::class,'showSignUpForm'])->name('signup');
Route::post('/signup/create',[LoginSignUp::class,'signup'])->name('user.signup');


//Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');





// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
  

    Route::middleware(['auth.admin'])->group(function () {
        // Route::get('/dashboard', function () {
        //     return 'Admin Dashboard';
        // })->name('admin.dashboard');
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        Route::post('/logout',[AdminController::class, 'Logout'])->name('logout');

        Route::get('/view/profile', [AdminController::class, 'viewprofile'])->name('viewprofile');
        Route::get('/add/department}', [AdminController::class, 'addDepartment'])->name('addDepartment');
        Route::get('/edit/profile/{id}', [AdminController::class, 'editprofile'])->name('editprofile');
        Route::put('/update/profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateprofile');
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
        Route::get('/manage/classes/add', [AdminController::class, 'addclasses'])->name('admin.addClass');
        Route::get('/manage/classes/create', [ClassTController::class, 'create'])->name('admin.createclass');
        Route::post('/manage/classes/store', [ClassTController::class, 'store'])->name('admin.storeClass');
        Route::get('/manage/classes/show/{class}', [ClassTController::class, 'show'])->name('admin.showClass');
        Route::get('/manage/classes/edit/{class}', [ClassTController::class, 'edit'])->name('admin.editclass');
        Route::put('/manage/classes/update/{class}', [ClassTController::class, 'update'])->name('admin.updateClass');
        Route::post('/manage/classes/delete/{class}', [ClassTController::class, 'destroy'])->name('admin.deleteClass');

        //Teachers
        Route::get('/manage/teachers', [AdminController::class, 'manageTeachers'])->name('admin.manageTeachers');
        Route::get('/manage/teachers/view/{teacher}', [AdminController::class, 'viewTeachers'])->name('admin.viewTeacher');
        Route::get('/manage/teachers/modify/{teacher}', [AdminController::class, 'editTeachers'])->name('admin.editTeacher');
        Route::get('/manage/teachers/add/{wteacher}', [AdminController::class, 'addteachers'])->name('admin.addTeacher');//
        Route::get('/manage/teachers/create/{wteacher}', [TeacherController::class, 'create'])->name('admin.createteacher');
        Route::post('/manage/teachers/store', [TeacherController::class, 'store'])->name('admin.storeteacher');
        Route::get('/manage/teachers/show/{teacher}', [TeacherController::class, 'show'])->name('admin.showTeacher');
        Route::get('/manage/teachers/edit/{teacher}', [TeacherController::class, 'edit'])->name('admin.editteacher');
        Route::put('/manage/teachers/update/{teacher}', [TeacherController::class, 'update'])->name('admin.updateteacher');
        Route::post('/manage/teachers/delete/{teacher}', [TeacherController::class, 'destroy'])->name('admin.deleteTeacher');
        Route::get('/manaeg/register/pendingteachers',[AdminController::class, 'viewPendingTeachers'])->name('viewpendteacher');

        //Students
        Route::get('/manage/students', [AdminController::class, 'manageStudents'])->name('admin.manageStudents');
        Route::get('/manage/students/view/{student}', [AdminController::class, 'viewStudents'])->name('admin.viewStudent');
        Route::get('/manage/students/modify/{student}', [AdminController::class, 'editStudents'])->name('admin.editStudent');
        Route::get('/manage/students/add/{wstudent}', [AdminController::class, 'addstudents'])->name('admin.addStudent');//
        Route::get('/manage/students/create/{wstudent}', [StudentController::class, 'create'])->name('admin.createstudent');
        Route::post('/manage/students/store', [StudentController::class, 'store'])->name('admin.storestudent');
        Route::get('/manage/students/show/{student}', [StudentController::class, 'show'])->name('admin.showStudent');
        Route::get('/manage/students/edit/{student}', [StudentController::class, 'edit'])->name('admin.editstudent');
        Route::put('/manage/students/update/{student}', [StudentController::class, 'update'])->name('admin.updatestudent');
        Route::post('/manage/students/delete/{student}', [StudentController::class, 'destroy'])->name('admin.deleteStudent');
        Route::get('/manaeg/register/pendingstudents',[AdminController::class, 'viewPendingStudents'])->name('viewpendstudent');

//Parents
        Route::get('/manage/parents', [AdminController::class, 'manageparents'])->name('admin.manageparents');
        Route::get('/manage/parents/modify/{parent}', [AdminController::class, 'editparents'])->name('admin.editparent');
        Route::get('/manage/parents/add/{wparent}', [AdminController::class, 'addparents'])->name('admin.addparents');//
        Route::get('/manage/parents/create/{wparent}', [SParentController::class, 'create'])->name('admin.createparents');
        Route::post('/manage/parents/store', [SParentController::class, 'store'])->name('admin.storeparents');
        Route::get('/manage/parents/show/{parent}', [SParentController::class, 'show'])->name('admin.showparent');
        Route::get('/manage/parents/edit/{parent}', [SparentController::class, 'edit'])->name('admin.editparents');
        Route::put('/manage/parents/update/{parent}', [SParentController::class, 'update'])->name('admin.updateparents');
        Route::post('/manage/parents/delete/{parent}', [SParentController::class, 'destroy'])->name('admin.deleteparent');
        Route::get('/manaeg/register/pendingparents',[AdminController::class, 'viewPendingparents'])->name('viewpendparents');

        //Alumnis
        Route::get('/manage/alumnis', [AdminController::class, 'managealumnis'])->name('admin.managealumnis');
        Route::get('/manage/alumnis/view/{alumni}', [AdminController::class, 'viewAlumni'])->name('admin.viewalumni');
        //PendingUsers
        Route::post('/manage/pending/delete/{pending}', [PendingController::class, 'destroy'])->name('admin.deletePUser');

        //students
        
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
        //Route::get('/student/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
        Route::get('/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
        Route::get('/manage/events', [StudentController::class, 'manageEvent'])->name('student.manageevents');
        Route::get('/manage/class', [StudentController::class, 'manageClass'])->name('student.manageclass');
        Route::get('/manage/Q&A', [StudentController::class, 'manageQandA'])->name('student.manageQ&A');
        Route::get('/manage/calendar', [StudentController::class, 'viewCalendar'])->name('student.viewCalendar');
        Route::get('/view/profile', [StudentController::class, 'viewProfile'])->name('student.viewprofile');
        Route::get('/edit/profile/{id}', [StudentController::class, 'editProfile'])->name('student.editprofile');
      
        Route::get('/view/class/{id}', [StudentController::class, 'viewClass'])->name('student.viewclass');
        Route::get('/view/resource/{class}', [StudentController::class, 'viewResource'])->name('student.viewresources');
        Route::get('/view/assignment/{class}', [StudentController::class, 'viewAssignment'])->name('student.viewassignments');
        Route::get('/view/submission/{class}', [StudentController::class, 'viewSubmission'])->name('student.viewsubmissions');
        Route::get('/add/submission/{assignment}', [StudentController::class, 'addSubmission'])->name('student.addsubmission');
        Route::post('/add/submission/', [StudentController::class, 'submitAssignment'])->name('submit.assignment');
        Route::get('/enroll/class/', [StudentController::class, 'enrollClass'])->name('student.enrollClass');
        Route::get('/enroll/{classId}', [StudentController::class, 'enroll'])->name('student.enroll');
        Route::post('/enroll/event/{eventId}', [StudentController::class, 'enrollEvent'])->name('student.enrollToEvent');
        Route::get('/add/reviewc/', [StudentController::class, 'addReviewc'])->name('student.addReviewC');
        Route::get('/student/addReviewE/{eventId}', [StudentController::class, 'addReviewE'])->name('student.addReviewE');
        Route::post('/student/submitReviewE/{eventId}', [StudentController::class, 'submitReviewE'])->name('student.submitReviewE');
        Route::get('/view/event/{id}', [StudentController::class, 'viewEvent'])->name('student.viewEvent');
        Route::get('/all-events', [StudentController::class, 'showAllEvents'])->name('student.showAllEvents');
        Route::post('/logout',[StudentController::class, 'Logout'])->name('student.logout');
        Route::get('/student/addquestion', [StudentController::class,'addQuestion'])->name('student.addquestion');
        Route::post('/student/storequestion',[StudentController::class,'storeQuestion'])->name('student.storequestion');
        Route::get('/student/addreviewc/{classId}', [StudentController::class,'addReviewc'])->name('student.addReviewcForm');
        Route::post('/student/storereviewc', [StudentController::class,'storeReviewc'])->name('student.storereviewc');

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
        Route::get('/view/profile',[SParentController::class,'viewProfile'])->name('parent.viewprofile');    
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
        Route::get('/view/profile',[TeacherController::class,'viewProfile'])->name('teacher.viewprofile');
        //Classes
        Route::get('/manage/classes', [TeacherController::class, 'manageClasses'])->name('teacher.manageClasses');
        Route::get('/manage/classes/create', [ClassTController::class, 'createT'])->name('teacher.createClass');
        Route::post('/manage/classes/store', [ClassTController::class, 'storeT'])->name('teacher.storeClass');
        Route::get('/manage/classes/show/{class}', [ClassTController::class, 'showT'])->name('teacher.showClass');
        Route::get('/manage/classes/edit/{class}', [ClassTController::class, 'edit'])->name('teacher.editclass');
        Route::put('/manage/classes/update/{class}', [ClassTController::class, 'update'])->name('teacher.updateClass');
        Route::post('/manage/classes/delete/{class}', [ClassTController::class, 'destroy'])->name('teacher.deleteClass');
 
        //Certificates
        Route::get('/manage/certificates', [TeacherController::class, 'manageCertificates'])->name('teacher.manageCertificates');
        Route::get('/manage/certificates/create', [TeacherController::class, 'createC'])->name('teacher.createCertificate');
        Route::post('/manage/certificates/store', [TeacherController::class, 'storeC'])->name('teacher.storeCertificate');


        //Students
        Route::get('/teacher/classes/{class}/students/{student}/edit', [TeacherController::class, 'editStudentGrades'])->name('editStudentGrades');
        Route::post('/teacher/classes/{class}/students/{student}/update', [TeacherController::class, 'storeStudentGrades'])->name('storeStudentGrades');

    });
});