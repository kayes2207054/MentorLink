<?php

use App\Models\MentorProfile;
use App\Models\Skill;
use App\Models\User;

test('mentor can create and view profile', function () {
    $mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);
    $skill = Skill::create(['name' => 'Laravel']);

    $response = $this->actingAs($mentor)->post(route('mentor.profile.store'), [
        'designation' => 'Senior Student Mentor',
        'experience' => 'Two years of peer mentoring.',
        'bio' => 'I help students with backend development.',
        'skills' => [$skill->id],
    ]);

    $response->assertRedirect(route('mentor.profile.show'));

    $profile = MentorProfile::first();

    expect($profile)
        ->user_id->toBe($mentor->id)
        ->designation->toBe('Senior Student Mentor')
        ->is_verified->toBeFalse();

    $this->assertDatabaseHas('mentor_skill', [
        'mentor_profile_id' => $profile->id,
        'skill_id' => $skill->id,
    ]);

    $this->actingAs($mentor)
        ->get(route('mentor.profile.show'))
        ->assertOk()
        ->assertSee('Senior Student Mentor')
        ->assertSee('Laravel');
});

test('mentor can edit and update profile', function () {
    $mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);
    $oldSkill = Skill::create(['name' => 'Python']);
    $newSkill = Skill::create(['name' => 'Research']);
    $profile = $mentor->mentorProfile()->create([
        'designation' => 'Mentor',
        'experience' => 'Original experience.',
        'bio' => 'Original bio.',
    ]);
    $profile->skills()->sync([$oldSkill->id]);

    $this->actingAs($mentor)
        ->get(route('mentor.profile.edit'))
        ->assertOk()
        ->assertSee('Mentor');

    $this->actingAs($mentor)->patch(route('mentor.profile.update'), [
        'designation' => 'Lead Mentor',
        'experience' => 'Updated experience.',
        'bio' => 'Updated bio.',
        'skills' => [$newSkill->id],
    ])->assertRedirect(route('mentor.profile.show'));

    $this->assertDatabaseHas('mentor_profiles', [
        'user_id' => $mentor->id,
        'designation' => 'Lead Mentor',
    ]);
    $this->assertDatabaseHas('mentor_skill', [
        'mentor_profile_id' => $profile->id,
        'skill_id' => $newSkill->id,
    ]);
    $this->assertDatabaseMissing('mentor_skill', [
        'mentor_profile_id' => $profile->id,
        'skill_id' => $oldSkill->id,
    ]);
});

test('mentor profile validation requires valid fields', function () {
    $mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);

    $this->actingAs($mentor)
        ->post(route('mentor.profile.store'), [
            'designation' => '',
            'experience' => '',
            'bio' => '',
            'skills' => [999],
        ])
        ->assertSessionHasErrors(['designation', 'experience', 'bio', 'skills.0']);
});

test('student cannot access mentor profile routes', function () {
    $student = User::factory()->create(['role' => User::ROLE_STUDENT]);

    $this->actingAs($student)
        ->get(route('mentor.profile.create'))
        ->assertForbidden();
});

test('admin can view mentor profile but cannot edit it', function () {
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    $mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);
    $skill = Skill::create(['name' => 'Career Guidance']);
    $profile = $mentor->mentorProfile()->create([
        'designation' => 'Career Mentor',
        'experience' => 'Guidance experience.',
        'bio' => 'Mentor bio.',
    ]);
    $profile->skills()->sync([$skill->id]);

    $this->actingAs($admin)
        ->get(route('admin.mentor-profiles.show', $profile))
        ->assertOk()
        ->assertSee('Career Mentor')
        ->assertSee('Career Guidance');

    $this->actingAs($admin)
        ->get(route('mentor.profile.edit'))
        ->assertForbidden();
});
