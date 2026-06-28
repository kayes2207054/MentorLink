<?php

use App\Models\Department;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('student can create and view profile', function () {
    $student = User::factory()->create(['role' => User::ROLE_STUDENT]);
    $department = Department::create(['name' => 'Computer Science']);

    $response = $this->actingAs($student)->post(route('student.profile.store'), [
        'student_id' => 'STU-1001',
        'department_id' => $department->id,
        'academic_year' => 'Third Year',
        'semester' => 'Spring',
        'bio' => 'Interested in academic mentorship.',
    ]);

    $response->assertRedirect(route('student.profile.show'));

    $profile = StudentProfile::first();

    expect($profile)
        ->user_id->toBe($student->id)
        ->student_id->toBe('STU-1001');

    $this->actingAs($student)
        ->get(route('student.profile.show'))
        ->assertOk()
        ->assertSee('STU-1001');
});

test('student can edit and update profile', function () {
    $student = User::factory()->create(['role' => User::ROLE_STUDENT]);
    $department = Department::create(['name' => 'Electrical Engineering']);
    $newDepartment = Department::create(['name' => 'Mechanical Engineering']);

    $student->studentProfile()->create([
        'student_id' => 'STU-1002',
        'department_id' => $department->id,
        'academic_year' => 'Second Year',
        'semester' => 'Fall',
        'bio' => 'Original bio.',
    ]);

    $this->actingAs($student)
        ->get(route('student.profile.edit'))
        ->assertOk()
        ->assertSee('STU-1002');

    $this->actingAs($student)->patch(route('student.profile.update'), [
        'student_id' => 'STU-2002',
        'department_id' => $newDepartment->id,
        'academic_year' => 'Final Year',
        'semester' => 'Summer',
        'bio' => 'Updated bio.',
    ])->assertRedirect(route('student.profile.show'));

    $this->assertDatabaseHas('student_profiles', [
        'user_id' => $student->id,
        'student_id' => 'STU-2002',
        'department_id' => $newDepartment->id,
        'academic_year' => 'Final Year',
    ]);
});

test('student profile validation requires valid fields', function () {
    $student = User::factory()->create(['role' => User::ROLE_STUDENT]);

    $this->actingAs($student)
        ->post(route('student.profile.store'), [
            'student_id' => '',
            'department_id' => 999,
            'academic_year' => '',
            'semester' => '',
            'bio' => '',
            'profile_photo' => UploadedFile::fake()->create('document.pdf', 10, 'application/pdf'),
        ])
        ->assertSessionHasErrors(['student_id', 'department_id', 'academic_year', 'semester', 'bio', 'profile_photo']);
});

test('mentor cannot access student profile routes', function () {
    $mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);

    $this->actingAs($mentor)
        ->get(route('student.profile.create'))
        ->assertForbidden();
});

test('admin can view student profile but cannot edit it', function () {
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    $student = User::factory()->create(['role' => User::ROLE_STUDENT]);
    $department = Department::create(['name' => 'Architecture']);
    $profile = $student->studentProfile()->create([
        'student_id' => 'STU-3003',
        'department_id' => $department->id,
        'academic_year' => 'First Year',
        'semester' => 'Fall',
        'bio' => 'Student bio.',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.student-profiles.show', $profile))
        ->assertOk()
        ->assertSee('STU-3003');

    $this->actingAs($admin)
        ->get(route('student.profile.edit'))
        ->assertForbidden();
});
