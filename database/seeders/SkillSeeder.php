<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Programming',
            'Web Development',
            'Database',
            'Laravel',
            'Python',
            'Java',
            'Competitive Programming',
            'Research',
            'Career Guidance',
            'Public Speaking',
        ])->each(fn (string $name) => Skill::updateOrCreate(['name' => $name]));
    }
}
