<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramController;
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
});

require __DIR__.'/auth.php';
//example of a protected route
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware('role:admin');
