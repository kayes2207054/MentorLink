<?php

namespace Tests\Feature;

use App\Models\MentorProfile;
use App\Models\SessionBooking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SessionBookingTest extends TestCase
{
    use RefreshDatabase;

    private User $mentor;

    private User $student;

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

        $this->student = User::factory()->create(['role' => User::ROLE_STUDENT]);
    }

    public function test_student_can_book_session()
    {
        $availability = $this->mentor->mentorProfile->availabilities()->create([
            'day_of_week' => now()->addDay()->format('l'),
            'start_time' => '10:00',
            'end_time' => '11:00',
        ]);

        $bookingDate = now()->addDay()->format('Y-m-d');

        $response = $this->actingAs($this->student)->post(route('student.bookings.store', $this->mentor), [
            'availability_id' => $availability->id,
            'booking_date' => $bookingDate,
            'note' => 'Looking forward to it!',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('session_bookings', [
            'mentor_id' => $this->mentor->id,
            'student_id' => $this->student->id,
            'status' => 'pending',
            'note' => 'Looking forward to it!',
        ]);
    }

    public function test_student_cannot_double_book_slot()
    {
        $availability = $this->mentor->mentorProfile->availabilities()->create([
            'day_of_week' => now()->addDay()->format('l'),
            'start_time' => '10:00',
            'end_time' => '11:00',
        ]);

        $bookingDate = now()->addDay()->format('Y-m-d');

        SessionBooking::create([
            'mentor_id' => $this->mentor->id,
            'student_id' => $this->student->id,
            'availability_id' => $availability->id,
            'booking_date' => $bookingDate,
            'status' => 'accepted',
        ]);

        $response = $this->actingAs($this->student)->post(route('student.bookings.store', $this->mentor), [
            'availability_id' => $availability->id,
            'booking_date' => $bookingDate,
        ]);

        $response->assertSessionHasErrors('availability_id');
    }

    public function test_mentor_can_accept_booking()
    {
        $availability = $this->mentor->mentorProfile->availabilities()->create([
            'day_of_week' => now()->addDay()->format('l'),
            'start_time' => '10:00',
            'end_time' => '11:00',
        ]);

        $booking = SessionBooking::create([
            'mentor_id' => $this->mentor->id,
            'student_id' => $this->student->id,
            'availability_id' => $availability->id,
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->mentor)->patch(route('mentor.bookings.updateStatus', $booking), [
            'status' => 'accepted',
        ]);

        $response->assertRedirect();
        $this->assertEquals('accepted', $booking->fresh()->status);
    }
}
