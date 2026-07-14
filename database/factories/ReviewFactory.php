<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\SessionBooking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'session_booking_id' => SessionBooking::factory(), // overridden in seeder
            'student_id' => User::factory(), // overridden in seeder
            'mentor_id' => User::factory(), // overridden in seeder
            'rating' => fake()->numberBetween(3, 5), // Mostly positive reviews
            'title' => fake()->sentence(4),
            'comment' => fake()->paragraph(),
        ];
    }
}
