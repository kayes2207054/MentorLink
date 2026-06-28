<?php

namespace Database\Seeders;

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
        User::updateOrCreate([
            'email' => 'admin@mentorlink.test',
        ], [
            'name' => 'MentorLink Admin',
            'role' => User::ROLE_ADMIN,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
