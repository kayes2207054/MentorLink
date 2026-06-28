<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/mentor/dashboard', function () {
    return view('mentor.dashboard');
})->middleware(['auth', 'verified', 'role:'.User::ROLE_MENTOR])->name('mentor.dashboard');

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth', 'verified', 'role:'.User::ROLE_STUDENT])->name('student.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
