<?php

namespace Tests\Feature;

use App\Models\MentorProfile;
use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MentorshipRequestTest extends TestCase
{
    use RefreshDatabase;

    private User $student;

    private User $mentor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = User::factory()->create(['role' => User::ROLE_STUDENT]);

        $this->mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);
        MentorProfile::create([
            'user_id' => $this->mentor->id,
            'designation' => 'Senior Developer',
            'experience' => '5 years of experience',
            'bio' => 'A passionate mentor.',
            'is_verified' => true,
        ]);
    }

    public function test_student_can_view_mentor_directory()
    {
        $response = $this->actingAs($this->student)->get(route('student.mentors.index'));
        $response->assertStatus(200);
        $response->assertSee($this->mentor->name);
    }

    public function test_student_can_send_mentorship_request()
    {
        $response = $this->actingAs($this->student)->post(route('student.mentorship-requests.store'), [
            'mentor_id' => $this->mentor->id,
            'message' => 'Please mentor me.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('mentorship_requests', [
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'status' => 'pending',
            'message' => 'Please mentor me.',
        ]);
    }

    public function test_student_cannot_send_duplicate_pending_request()
    {
        MentorshipRequest::create([
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'status' => 'pending',
            'message' => 'First request',
        ]);

        $response = $this->actingAs($this->student)->post(route('student.mentorship-requests.store'), [
            'mentor_id' => $this->mentor->id,
            'message' => 'Second request',
        ]);

        $response->assertSessionHasErrors('mentor_id');
        $this->assertEquals(1, MentorshipRequest::where('student_id', $this->student->id)->count());
    }

    public function test_mentor_can_accept_request()
    {
        $request = MentorshipRequest::create([
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'status' => 'pending',
            'message' => 'Hi',
        ]);

        $response = $this->actingAs($this->mentor)->patch(route('mentor.mentorship-requests.update', $request), [
            'status' => 'accepted',
        ]);

        $response->assertRedirect(route('mentor.dashboard'));
        $this->assertDatabaseHas('mentorship_requests', [
            'id' => $request->id,
            'status' => 'accepted',
        ]);
    }

    public function test_mentor_can_reject_request()
    {
        $request = MentorshipRequest::create([
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'status' => 'pending',
            'message' => 'Hi',
        ]);

        $response = $this->actingAs($this->mentor)->patch(route('mentor.mentorship-requests.update', $request), [
            'status' => 'rejected',
        ]);

        $response->assertRedirect(route('mentor.dashboard'));
        $this->assertDatabaseHas('mentorship_requests', [
            'id' => $request->id,
            'status' => 'rejected',
        ]);
    }
}
