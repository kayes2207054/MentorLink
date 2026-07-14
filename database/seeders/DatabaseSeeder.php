<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\MentorAvailability;
use App\Models\MentorProfile;
use App\Models\MentorshipRequest;
use App\Models\Review;
use App\Models\SessionBooking;
use App\Models\Skill;
use App\Models\StudentProfile;
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
        // 1. Seed base data
        $this->call([
            DepartmentSeeder::class,
            SkillSeeder::class,
        ]);

        $departments = Department::all();
        $skills = Skill::all();

        // 2. Create Admin
        User::factory()->admin()->create([
            'name' => 'MentorLink Admin',
            'email' => 'admin@mentorlink.test',
            'password' => Hash::make('password'),
        ]);

        // 3. Create Mentors
        $mentors = User::factory()->mentor()->count(12)->create();

        // Custom fixed mentors for testing login easily
        $mentors[0]->update([
            'name' => 'Sarah Johnson',
            'email' => 'mentor@mentorlink.test',
        ]);

        foreach ($mentors as $mentor) {
            $profile = MentorProfile::factory()->create([
                'user_id' => $mentor->id,
            ]);

            // Attach random skills (3 to 6)
            if ($skills->count() > 0) {
                $profile->skills()->attach(
                    $skills->random(rand(3, 6))->pluck('id')->toArray()
                );
            }

            // Create availability slots (3 to 5)
            MentorAvailability::factory()->count(rand(3, 5))->create([
                'mentor_profile_id' => $profile->id,
            ]);
        }

        // 4. Create Students
        $students = User::factory()->student()->count(40)->create();

        // Custom fixed student for testing login easily
        $students[0]->update([
            'name' => 'Alex Rodriguez',
            'email' => 'student@mentorlink.test',
        ]);

        foreach ($students as $student) {
            StudentProfile::factory()->create([
                'user_id' => $student->id,
                'department_id' => $departments->random()->id,
            ]);
        }

        // 5. Create Interactions
        // Give each student a chance to interact with a few mentors
        foreach ($students as $student) {
            // Pick 1 to 3 random mentors for this student
            $selectedMentors = $mentors->random(rand(1, 3));

            foreach ($selectedMentors as $mentor) {
                // 50% chance they made a mentorship request
                if (rand(1, 100) > 50) {
                    MentorshipRequest::factory()->create([
                        'student_id' => $student->id,
                        'mentor_id' => $mentor->id,
                    ]);
                }

                // 60% chance they booked a session
                if (rand(1, 100) > 40) {
                    $availabilities = $mentor->mentorProfile->availabilities;
                    if ($availabilities->count() > 0) {
                        $availability = $availabilities->random();

                        $booking = SessionBooking::factory()->create([
                            'student_id' => $student->id,
                            'mentor_id' => $mentor->id,
                            'availability_id' => $availability->id,
                        ]);

                        // If the booking is completed, there's an 80% chance they left a review
                        if ($booking->status === 'completed' && rand(1, 100) > 20) {
                            Review::factory()->create([
                                'session_booking_id' => $booking->id,
                                'student_id' => $student->id,
                                'mentor_id' => $mentor->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
