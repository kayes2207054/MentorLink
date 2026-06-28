<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Computer Science',
            'Electrical Engineering',
            'Mechanical Engineering',
            'Civil Engineering',
            'Architecture',
            'Business Administration',
        ])->each(fn (string $name) => Department::updateOrCreate(['name' => $name]));
    }
}
