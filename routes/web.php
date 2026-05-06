<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseUnitController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::patch('/admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin', [AdminController::class, 'delete'])->name('admin.delete');

    Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
    Route::get('/program/create', [ProgramController::class, 'create'])->name('program.create');
    Route::get('/program/show/{id}', [ProgramController::class, 'show'])->name('program.show');
    Route::get('/program/edit/{id}', [ProgramController::class, 'edit'])->name('program.edit');
    Route::post('/program/store', [ProgramController::class, 'store'])->name('program.store');
    Route::patch('/program/update', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('/program', [ProgramController::class, 'delete'])->name('program.delete');

    Route::get('/courseUnit', [CourseUnitController::class, 'index'])->name('courseUnit.index');
    Route::get('/courseUnit/create', [CourseUnitController::class, 'create'])->name('courseUnit.create');
    Route::get('/courseUnit/show/{id}', [CourseUnitController::class, 'show'])->name('courseUnit.show');
    Route::get('/courseUnit/edit/{id}', [CourseUnitController::class, 'edit'])->name('courseUnit.edit');
    Route::post('/courseUnit/store', [CourseUnitController::class, 'store'])->name('courseUnit.store');
    Route::patch('/courseUnit/update', [CourseUnitController::class, 'update'])->name('courseUnit.update');
    Route::delete('/courseUnit', [CourseUnitController::class, 'delete'])->name('courseUnit.delete');


    // Only users with 'student' role can access these
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
        Route::get('/courses/{id}', [StudentController::class, 'courseShow'])->name('courses.show');
        Route::get('/grades', [StudentController::class, 'grades'])->name('grades');
        Route::get('/attendance', [StudentController::class, 'attendance'])->name('attendance');
        Route::get('/schedule', [StudentController::class, 'schedule'])->name('schedule');
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    });

    // ==================== LECTURER ROUTES ====================
    // Only users with 'lecturer' role can access these
    Route::middleware(['role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
        Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [LecturerController::class, 'courses'])->name('courses');
        Route::get('/courses/{id}', [LecturerController::class, 'courseShow'])->name('courses.show');
        Route::get('/students/{id}', [LecturerController::class, 'studentShow'])->name('student.show');
        Route::get('/schedule', [LecturerController::class, 'schedule'])->name('schedule');
    });
});

require __DIR__.'/auth.php';
//example of a protected route
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware('role:admin');
