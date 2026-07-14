<?php

namespace Database\Factories;

use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentorProfile>
 */
class MentorProfileFactory extends Factory
{
    protected $model = MentorProfile::class;

    public function definition(): array
    {
        $designations = [
            'Senior Software Engineer', 'Lead Data Scientist', 'Product Manager',
            'UX/UI Designer', 'Cloud Solutions Architect', 'Frontend Developer',
            'Full Stack Engineer', 'Machine Learning Engineer', 'DevOps Engineer',
            'Data Analyst', 'Security Specialist', 'Mobile App Developer',
        ];

        return [
            'user_id' => User::factory(), // overridden in seeder
            'designation' => fake()->randomElement($designations).' at '.fake()->company(),
            'experience' => 'I have '.fake()->numberBetween(5, 15).'+ years of experience working in tech. '.fake()->paragraph(2),
            'bio' => fake()->paragraph(3),
            'is_verified' => true,
            'verified_at' => now(),
        ];
    }
}
