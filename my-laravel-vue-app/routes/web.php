<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/', function () {
    if (Auth::check()) {
        // User is logged in, redirect based on role
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.index'); // Replace with your admin route
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teachers.index'); // Replace with your teacher route
        } elseif ($user->role === 'student') {
            return redirect()->route('students.index'); // Replace with your student route
        }
    }

    // User is not logged in, redirect to login page
    return redirect()->route('login'); // Adjust this if your login route is different
});

Route::middleware(['auth'])->group(function () {
    // Teacher routes
 Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/my-students', [TeacherController::class, 'myStudents'])->name('teachers.my_students');
    Route::get('/teachers/create-student', [TeacherController::class, 'create'])->name('teachers.create_student');
    Route::post('/teachers/store-student', [TeacherController::class, 'store'])->name('teachers.store_student');
    Route::post('/teachers/assign-student/{id}', [TeacherController::class, 'assignStudent'])->name('teachers.assign_student');
    Route::post('/teachers/unassign-student/{id}', [TeacherController::class, 'unassignStudent'])->name('teachers.unassign_student');
    Route::delete('/teachers/students/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy_student');
 });
 
    // Student routes
 Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/my-teacher', [StudentController::class, 'myTeacher'])->name('students.my_teacher');
    Route::get('/students/similar', [StudentController::class, 'similarStudents'])->name('students.similar_students');
  });
  
    // Admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Admin routes
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.destroy_user');
        
        // Routes for creating teachers and students
        Route::get('/admin/create-teacher', [AdminController::class, 'createTeacher'])->name('admin.create_teacher');
        Route::post('/admin/store-teacher', [AdminController::class, 'storeTeacher'])->name('admin.store_teacher');
    
        Route::get('/admin/create-student', [AdminController::class, 'createStudent'])->name('admin.create_student');
        Route::post('/admin/store-student', [AdminController::class, 'storeStudent'])->name('admin.store_student');

        Route::get('/admin/edit-student/{id}', [AdminController::class, 'editStudent'])->name('admin.edit-student');
        Route::put('/admin/students/{id}', [AdminController::class, 'updateStudent'])->name('admin.update-student');

        Route::get('/admin/edit-teacher/{id}', [AdminController::class, 'editTeacher'])->name('admin.editTeacher');
        Route::put('/admin/teachers/{id}', [AdminController::class, 'updateTeacher'])->name('admin.updateTeacher');

        Route::get('/admin/add-school', [AdminController::class, 'createSchool'])->name('admin.create-school');
        Route::post('/admin/store-school', [AdminController::class, 'storeSchool'])->name('admin.store-school');
    });
    
    // Profile page route
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Update profile route
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
Auth::routes();

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/'); // Redirect to home if logged in
    }

    // Otherwise, show the login view
    return view('auth.login');
})->name('login');

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');