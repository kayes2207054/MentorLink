<?php

namespace Database\Factories;

use App\Models\MentorAvailability;
use App\Models\SessionBooking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SessionBooking>
 */
class SessionBookingFactory extends Factory
{
    protected $model = SessionBooking::class;

    public function definition(): array
    {
        $statuses = ['pending', 'accepted', 'completed', 'cancelled'];

        return [
            'student_id' => User::factory(), // overridden in seeder
            'mentor_id' => User::factory(), // overridden in seeder
            'availability_id' => MentorAvailability::factory(), // overridden in seeder
            'booking_date' => fake()->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'status' => fake()->randomElement($statuses),
            'note' => fake()->sentence(),
        ];
    }
}
