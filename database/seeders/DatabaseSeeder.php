<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\MentorAvailability;
use App\Models\MentorshipRequest;
use App\Models\Review;
use App\Models\SessionBooking;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            SkillSeeder::class,
        ]);

        // 1. Create Admin
        User::updateOrCreate([
            'email' => 'admin@mentorlink.test',
        ], [
            'name' => 'MentorLink Admin',
            'role' => User::ROLE_ADMIN,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // 2. Create Realistic Mentors
        $mentor1 = User::updateOrCreate([
            'email' => 'sarah@mentorlink.test',
        ], [
            'name' => 'Sarah Johnson',
            'role' => User::ROLE_MENTOR,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $mentor1->mentorProfile()->updateOrCreate(
            ['user_id' => $mentor1->id],
            [
                'designation' => 'Senior Software Engineer at Google',
                'experience' => 'I have 8+ years of experience building scalable backend systems and distributed architectures. I specialize in Laravel, Python, and cloud infrastructure.',
                'bio' => 'Passionate about helping junior developers transition into mid-level and senior roles. I focus on system design, clean code practices, and career growth strategies.',
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        $mentor2 = User::updateOrCreate([
            'email' => 'david@mentorlink.test',
        ], [
            'name' => 'David Chen',
            'role' => User::ROLE_MENTOR,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $mentor2->mentorProfile()->updateOrCreate(
            ['user_id' => $mentor2->id],
            [
                'designation' => 'Lead Data Scientist',
                'experience' => 'Over 10 years of experience in Data Science, Machine Learning, and AI. Led multiple successful AI product launches in the fintech space.',
                'bio' => 'I love mentoring students interested in AI and Data Science. From Python basics to advanced Neural Networks, I can help you build a strong foundation.',
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        // Attach Skills
        $skills = Skill::all();
        if ($skills->count() > 0) {
            $mentor1->mentorProfile->skills()->syncWithoutDetaching($skills->random(3)->pluck('id')->toArray());
            $mentor2->mentorProfile->skills()->syncWithoutDetaching($skills->random(4)->pluck('id')->toArray());
        }

        // 3. Create Realistic Students
        $department = Department::first();

        $student1 = User::updateOrCreate([
            'email' => 'alex@mentorlink.test',
        ], [
            'name' => 'Alex Rodriguez',
            'role' => User::ROLE_STUDENT,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $student1->studentProfile()->updateOrCreate(
            ['user_id' => $student1->id],
            [
                'student_id' => 'STU-2024-001',
                'department_id' => $department->id ?? null,
                'academic_year' => '3rd Year',
                'semester' => 'Spring',
                'bio' => 'Aspiring software engineer looking for guidance on backend development and system design.',
            ]
        );

        $student2 = User::updateOrCreate([
            'email' => 'emily@mentorlink.test',
        ], [
            'name' => 'Emily Watson',
            'role' => User::ROLE_STUDENT,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $student2->studentProfile()->updateOrCreate(
            ['user_id' => $student2->id],
            [
                'student_id' => 'STU-2024-002',
                'department_id' => $department->id ?? null,
                'academic_year' => '4th Year',
                'semester' => 'Fall',
                'bio' => 'Data Science enthusiast trying to break into the industry. Seeking advice on ML projects.',
            ]
        );

        // 4. Create sample interactions (Requests, Bookings, Reviews)
        // Check if relationships exist before creating to avoid duplicates in seeder runs
        if (MentorshipRequest::count() === 0) {
            MentorshipRequest::create([
                'student_id' => $student1->id,
                'mentor_id' => $mentor1->id,
                'status' => 'accepted',
                'message' => 'Hi Sarah, I would love to learn system design from you!',
            ]);

            MentorshipRequest::create([
                'student_id' => $student2->id,
                'mentor_id' => $mentor2->id,
                'status' => 'pending',
                'message' => 'Hello David, your background in Data Science is exactly what I am looking for.',
            ]);

            // Add an availability for mentor1
            $availability = MentorAvailability::create([
                'mentor_id' => $mentor1->id,
                'day_of_week' => 'Monday',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
            ]);

            // Add a booking
            SessionBooking::create([
                'student_id' => $student1->id,
                'mentor_id' => $mentor1->id,
                'availability_id' => $availability->id,
                'booking_date' => now()->addDays(3)->format('Y-m-d'),
                'status' => 'accepted',
                'notes' => 'Looking forward to discussing my project architecture.',
            ]);

            // Add a completed session and a review
            $pastAvailability = MentorAvailability::create([
                'mentor_id' => $mentor1->id,
                'day_of_week' => 'Friday',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
            ]);

            $completedBooking = SessionBooking::create([
                'student_id' => $student1->id,
                'mentor_id' => $mentor1->id,
                'availability_id' => $pastAvailability->id,
                'booking_date' => now()->subDays(5)->format('Y-m-d'),
                'status' => 'completed',
                'notes' => 'First introductory session.',
            ]);

            Review::create([
                'student_id' => $student1->id,
                'mentor_id' => $mentor1->id,
                'session_booking_id' => $completedBooking->id,
                'rating' => 5,
                'title' => 'Amazing introductory session!',
                'comment' => 'Sarah was incredibly helpful in our first session. She gave me a clear roadmap for what I need to learn to master system design.',
            ]);
        }
    }
}
