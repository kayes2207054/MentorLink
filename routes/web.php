<?php

use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route(request()->user()->dashboardRoute());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:'.User::ROLE_ADMIN])->name('admin.dashboard');

Route::middleware(['auth', 'verified', 'role:'.User::ROLE_ADMIN])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/student-profiles/{studentProfile}', [StudentProfileController::class, 'adminShow'])
        ->name('student-profiles.show');
    Route::get('/mentor-profiles/{mentorProfile}', [MentorProfileController::class, 'adminShow'])
        ->name('mentor-profiles.show');
});

Route::get('/mentor/dashboard', function () {
    return view('mentor.dashboard');
})->middleware(['auth', 'verified', 'role:'.User::ROLE_MENTOR])->name('mentor.dashboard');

Route::middleware(['auth', 'verified', 'role:'.User::ROLE_MENTOR])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('/profile', [MentorProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/create', [MentorProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [MentorProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [MentorProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [MentorProfileController::class, 'update'])->name('profile.update');
});

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth', 'verified', 'role:'.User::ROLE_STUDENT])->name('student.dashboard');

Route::middleware(['auth', 'verified', 'role:'.User::ROLE_STUDENT])->prefix('student')->name('student.')->group(function () {
    Route::get('/profile', [StudentProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/create', [StudentProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [StudentProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
