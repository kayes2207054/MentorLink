<?php

namespace Tests\Feature;

use App\Models\MentorAvailability;
use App\Models\MentorProfile;
use App\Models\Review;
use App\Models\SessionBooking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    private User $student;

    private User $mentor;

    private SessionBooking $booking;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = User::factory()->create(['role' => User::ROLE_STUDENT]);
        $this->mentor = User::factory()->create(['role' => User::ROLE_MENTOR]);

        MentorProfile::create([
            'user_id' => $this->mentor->id,
            'designation' => 'Software Engineer',
            'experience' => '5 years',
            'company' => 'Google',
            'bio' => 'Test bio',
            'is_verified' => true,
        ]);

        $availability = MentorAvailability::create([
            'mentor_profile_id' => $this->mentor->mentorProfile->id,
            'day_of_week' => 'Monday',
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);

        $this->booking = SessionBooking::create([
            'mentor_id' => $this->mentor->id,
            'student_id' => $this->student->id,
            'availability_id' => $availability->id,
            'booking_date' => now()->next('Monday')->toDateString(),
            'status' => 'completed',
        ]);
    }

    public function test_student_can_review_completed_session()
    {
        $response = $this->actingAs($this->student)->post(route('student.reviews.store', $this->booking), [
            'rating' => 5,
            'title' => 'Great mentor',
            'comment' => 'Very helpful session.',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertDatabaseHas('reviews', [
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 5,
        ]);
    }

    public function test_student_cannot_review_uncompleted_session()
    {
        $this->booking->update(['status' => 'pending']);

        $response = $this->actingAs($this->student)->post(route('student.reviews.store', $this->booking), [
            'rating' => 5,
            'title' => 'Great mentor',
            'comment' => 'Very helpful session.',
        ]);

        $response->assertStatus(403);
    }

    public function test_student_cannot_submit_duplicate_review()
    {
        Review::create([
            'session_booking_id' => $this->booking->id,
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 5,
            'title' => 'First review',
            'comment' => 'Comment 1',
        ]);

        $response = $this->actingAs($this->student)->post(route('student.reviews.store', $this->booking), [
            'rating' => 4,
            'title' => 'Second review',
            'comment' => 'Comment 2',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $response->assertSessionHas('error');
        $this->assertEquals(1, Review::where('session_booking_id', $this->booking->id)->count());
    }

    public function test_student_can_update_own_review_within_7_days()
    {
        $review = Review::create([
            'session_booking_id' => $this->booking->id,
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 4,
            'title' => 'Good',
            'comment' => 'Good session.',
            'created_at' => now()->subDays(3), // 3 days ago
        ]);

        $response = $this->actingAs($this->student)->patch(route('student.reviews.update', $review), [
            'rating' => 5,
            'title' => 'Updated title',
            'comment' => 'Updated comment',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'rating' => 5,
            'title' => 'Updated title',
        ]);
    }

    public function test_student_cannot_update_review_after_7_days()
    {
        $review = Review::create([
            'session_booking_id' => $this->booking->id,
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 4,
            'title' => 'Good',
            'comment' => 'Good session.',
        ]);
        $review->created_at = now()->subDays(10);
        $review->saveQuietly();

        $response = $this->actingAs($this->student)->patch(route('student.reviews.update', $review), [
            'rating' => 5,
            'title' => 'Updated title',
            'comment' => 'Updated comment',
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_delete_any_review()
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $review = Review::create([
            'session_booking_id' => $this->booking->id,
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 4,
            'title' => 'Good',
            'comment' => 'Good session.',
            'created_at' => now()->subDays(10),
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.reviews.destroy', $review));

        $response->assertRedirect(route('admin.reviews.index'));
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }

    public function test_average_rating_calculation()
    {
        Review::create([
            'session_booking_id' => $this->booking->id,
            'student_id' => $this->student->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 4,
            'title' => 'R1',
            'comment' => 'C1',
        ]);

        $student2 = User::factory()->create(['role' => User::ROLE_STUDENT]);
        $booking2 = SessionBooking::create([
            'mentor_id' => $this->mentor->id,
            'student_id' => $student2->id,
            'availability_id' => $this->booking->availability_id,
            'booking_date' => now()->next('Monday')->addWeeks(1)->toDateString(),
            'status' => 'completed',
        ]);

        Review::create([
            'session_booking_id' => $booking2->id,
            'student_id' => $student2->id,
            'mentor_id' => $this->mentor->id,
            'rating' => 5,
            'title' => 'R2',
            'comment' => 'C2',
        ]);

        $this->assertEquals(4.5, $this->mentor->mentorProfile->averageRating());
        $this->assertEquals(2, $this->mentor->mentorProfile->totalReviews());
    }
}
