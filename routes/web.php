<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMentorController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\MentorDirectoryController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\MentorshipRequestController;
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

Route::middleware(['auth', 'verified', 'role:'.User::ROLE_ADMIN])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/status', [AdminUserController::class, 'updateStatus'])->name('users.updateStatus');

    Route::get('/mentors', [AdminMentorController::class, 'index'])->name('mentors.index');
    Route::patch('/mentors/{mentorProfile}/verify', [AdminMentorController::class, 'verify'])->name('mentors.verify');

    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);

    Route::get('/student-profiles/{studentProfile}', [StudentProfileController::class, 'adminShow'])
        ->name('student-profiles.show');
    Route::get('/mentor-profiles/{mentorProfile}', [MentorProfileController::class, 'adminShow'])
        ->name('mentor-profiles.show');
});

Route::get('/mentor/dashboard', function () {
    $requests = request()->user()->receivedMentorshipRequests()->with('student.studentProfile')->latest()->get();
    $pendingRequests = $requests->where('status', 'pending');
    $acceptedRequests = $requests->where('status', 'accepted');
    $rejectedRequests = $requests->where('status', 'rejected');

    return view('mentor.dashboard', compact('pendingRequests', 'acceptedRequests', 'rejectedRequests'));
})->middleware(['auth', 'verified', 'role:'.User::ROLE_MENTOR])->name('mentor.dashboard');

Route::middleware(['auth', 'verified', 'role:'.User::ROLE_MENTOR])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('/profile', [MentorProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/create', [MentorProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [MentorProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [MentorProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [MentorProfileController::class, 'update'])->name('profile.update');

    Route::patch('/mentorship-requests/{mentorship_request}', [MentorshipRequestController::class, 'update'])->name('mentorship-requests.update');
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

    Route::get('/mentors', [MentorDirectoryController::class, 'index'])->name('mentors.index');
    Route::get('/mentors/{mentor}', [MentorDirectoryController::class, 'show'])->name('mentors.show');

    Route::post('/mentorship-requests', [MentorshipRequestController::class, 'store'])->name('mentorship-requests.store');
    Route::delete('/mentorship-requests/{mentorship_request}', [MentorshipRequestController::class, 'destroy'])->name('mentorship-requests.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
