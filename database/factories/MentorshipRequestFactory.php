<?php

namespace Database\Factories;

use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentorshipRequest>
 */
class MentorshipRequestFactory extends Factory
{
    protected $model = MentorshipRequest::class;

    public function definition(): array
    {
        $statuses = ['pending', 'accepted', 'rejected'];

        return [
            'student_id' => User::factory(), // overridden in seeder
            'mentor_id' => User::factory(), // overridden in seeder
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement($statuses),
        ];
    }
}
