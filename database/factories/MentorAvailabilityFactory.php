<?php

namespace Database\Factories;

use App\Models\MentorAvailability;
use App\Models\MentorProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentorAvailability>
 */
class MentorAvailabilityFactory extends Factory
{
    protected $model = MentorAvailability::class;

    public function definition(): array
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $startHour = fake()->numberBetween(9, 16);
        $endHour = $startHour + fake()->numberBetween(1, 3);

        return [
            'mentor_profile_id' => MentorProfile::factory(), // overridden in seeder
            'day_of_week' => fake()->randomElement($days),
            'start_time' => sprintf('%02d:00:00', $startHour),
            'end_time' => sprintf('%02d:00:00', $endHour),
        ];
    }
}
