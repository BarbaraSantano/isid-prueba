<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstructorController;

// Ruta raíz
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->is_instructor
            ? redirect()->route('dashboard.instructor')
            : redirect()->route('dashboard.user');
    }
    return view('welcome');
})->name('home');

// Dashboard general
Route::get('/dashboard', function () {
    return auth()->user()->is_instructor
        ? redirect()->route('dashboard.instructor')
        : redirect()->route('dashboard.user');
})->name('dashboard');

// Dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
    Route::middleware(['instructor'])->get('/dashboard/instructor', [DashboardController::class, 'instructor'])->name('dashboard.instructor');
});

// Cursos para usuarios
Route::middleware(['auth'])->group(function () {
    Route::get('/user/courses/{course}', [UserController::class, 'showCourse'])->name('user.courses.show');
    Route::post('/user/courses/{course}/favorite', [UserController::class, 'toggleFavorite'])->name('user.courses.favorite');
    Route::post('/user/courses/{course}/reviews', [UserController::class, 'storeReview'])->name('user.courses.reviews.store');
});

// Cursos para instructores
Route::middleware(['auth', 'instructor'])->prefix('dashboard/instructor/courses')->group(function () {
    Route::get('/', [InstructorController::class, 'index'])->name('instructor.courses.index');
    Route::get('/create', [InstructorController::class, 'create'])->name('courses.create');
    Route::post('/', [InstructorController::class, 'store'])->name('courses.store');

    Route::middleware(['owner.course'])->group(function () {
        Route::get('/{course}/edit', [InstructorController::class, 'edit'])->name('courses.edit');
        Route::put('/{course}', [InstructorController::class, 'update'])->name('courses.update');
        Route::delete('/{course}', [InstructorController::class, 'destroy'])->name('courses.destroy');
        Route::get('/{course}', [InstructorController::class, 'showCourse'])->name('instructor.courses.show');
    });
});

// Instructores
Route::get('/instructors', [InstructorController::class, 'all'])->name('instructors.index');

// Requerido por Breeze
require __DIR__.'/auth.php';
