<?php

use App\Models\User;

test('users cannot access another role dashboard', function () {
    $student = User::factory()->create([
        'role' => User::ROLE_STUDENT,
    ]);

    $this->actingAs($student)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('users can access their own role dashboard', function () {
    $student = User::factory()->create([
        'role' => User::ROLE_STUDENT,
    ]);

    $this->actingAs($student)
        ->get(route('student.dashboard'))
        ->assertOk();
});
