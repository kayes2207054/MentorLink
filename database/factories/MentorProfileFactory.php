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

        $bios = [
            'Passionate mentor with several years of experience helping students develop practical skills and achieve their academic goals. I focus on building a strong foundation in core engineering principles.',
            'Dedicated software engineer who enjoys mentoring students in programming, problem solving, and career development. My goal is to bridge the gap between academic theory and industry practice.',
            'Experienced technology professional committed to guiding learners through real-world projects and continuous improvement. I believe in hands-on learning and practical application of skills.',
            'Enthusiastic leader with a background in driving successful tech initiatives. I love sharing my knowledge and helping mentees navigate their early careers with confidence and clarity.',
            'Results-oriented developer with a knack for simplifying complex technical concepts. I work closely with students to ensure they are well-prepared for technical interviews and professional challenges.',
            'Seasoned architect who has designed scalable systems for various startups. I enjoy providing architectural insights and mentoring aspiring developers in best practices and system design.',
            'Innovative professional dedicated to mentoring the next generation of engineers. I offer guidance on modern web technologies, agile workflows, and career progression.',
            'Tech enthusiast and experienced mentor. I specialize in helping students transition from learning syntax to building full-fledged applications ready for production.',
        ];

        return [
            'user_id' => User::factory(), // overridden in seeder
            'designation' => fake()->randomElement($designations).' at '.fake()->company(),
            'experience' => 'I have over '.fake()->numberBetween(5, 15).' years of experience working in tech, focusing on delivering high-quality solutions and mentoring junior team members.',
            'bio' => fake()->randomElement($bios),
            'is_verified' => true,
            'verified_at' => now(),
        ];
    }
}
