<?php

use App\Http\Controllers\Api\MentorApiController;
use Illuminate\Support\Facades\Route;

Route::get('/mentors', [MentorApiController::class, 'index'])->name('api.mentors.index');
