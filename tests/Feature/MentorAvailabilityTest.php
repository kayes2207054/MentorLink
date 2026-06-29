<?php

namespace Tests\Feature;

use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MentorAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    private User $mentor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);
        MentorProfile::create([
            'user_id' => $this->mentor->id,
            'designation' => 'Software Engineer',
            'experience' => '5 years',
            'company' => 'Google',
            'bio' => 'Test bio',
            'is_verified' => true,
        ]);
    }

    public function test_mentor_can_view_availabilities()
    {
        $response = $this->actingAs($this->mentor)->get(route('mentor.availabilities.index'));
        $response->assertStatus(200);
    }

    public function test_mentor_can_add_availability()
    {
        $response = $this->actingAs($this->mentor)->post(route('mentor.availabilities.store'), [
            'day_of_week' => 'Monday',
            'start_time' => '09:00',
            'end_time' => '11:00',
        ]);

        $response->assertRedirect(route('mentor.availabilities.index'));
        $this->assertDatabaseHas('mentor_availabilities', [
            'mentor_profile_id' => $this->mentor->mentorProfile->id,
            'day_of_week' => 'Monday',
            'start_time' => '09:00',
            'end_time' => '11:00',
        ]);
    }

    public function test_mentor_cannot_add_overlapping_availability()
    {
        $this->mentor->mentorProfile->availabilities()->create([
            'day_of_week' => 'Monday',
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
        ]);

        $response = $this->actingAs($this->mentor)->post(route('mentor.availabilities.store'), [
            'day_of_week' => 'Monday',
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);

        $response->assertSessionHasErrors('time');
    }

    public function test_mentor_can_delete_availability()
    {
        $availability = $this->mentor->mentorProfile->availabilities()->create([
            'day_of_week' => 'Tuesday',
            'start_time' => '14:00',
            'end_time' => '16:00',
        ]);

        $response = $this->actingAs($this->mentor)->delete(route('mentor.availabilities.destroy', $availability));

        $response->assertRedirect();
        $this->assertDatabaseMissing('mentor_availabilities', ['id' => $availability->id]);
    }
}
