<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudentProfile>
 */
class StudentProfileFactory extends Factory
{
    protected $model = StudentProfile::class;

    public function definition(): array
    {
        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year', 'Graduate'];
        $semesters = ['Fall', 'Spring', 'Summer'];

        return [
            'user_id' => User::factory(), // overridden in seeder
            'student_id' => 'STU-'.date('Y').'-'.fake()->unique()->numerify('####'),
            'department_id' => Department::inRandomOrder()->first()?->id,
            'academic_year' => fake()->randomElement($years),
            'semester' => fake()->randomElement($semesters),
            'bio' => fake()->paragraph(2),
        ];
    }
}
