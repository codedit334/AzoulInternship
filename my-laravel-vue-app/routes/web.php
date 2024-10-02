<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::get('/login', function () {
    return view('welcome'); // or any other view where you load Vue
})->name('login');

    
Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return Inertia::render('InertiaTest');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    // Teacher routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/my-students', [TeacherController::class, 'myStudents'])->name('teachers.my_students');
    Route::get('/teachers/create-student', [TeacherController::class, 'create'])->name('teachers.create_student');
    Route::post('/teachers/store-student', [TeacherController::class, 'store'])->name('teachers.store_student');
    Route::post('/teachers/assign-student/{id}', [TeacherController::class, 'assignStudent'])->name('teachers.assign_student');
    Route::post('/teachers/unassign-student/{id}', [TeacherController::class, 'unassignStudent'])->name('teachers.unassign_student');
    Route::delete('/teachers/students/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy_student');

    // Student routes
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/my-teacher', [StudentController::class, 'myTeacher'])->name('students.my_teacher');
    Route::get('/students/similar', [StudentController::class, 'similarStudents'])->name('students.similar_students');

    // Admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        // Admin routes
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.destroy_user');
        
        // Routes for creating teachers and students
        Route::get('/admin/create-teacher', [AdminController::class, 'createTeacher'])->name('admin.create_teacher');
        Route::post('/admin/store-teacher', [AdminController::class, 'storeTeacher'])->name('admin.store_teacher');
    
        Route::get('/admin/create-student', [AdminController::class, 'createStudent'])->name('admin.create_student');
        Route::post('/admin/store-student', [AdminController::class, 'storeStudent'])->name('admin.store_student');
    });
});
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');