<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Directory;
use App\Models\Section;
use App\Models\Student;
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
        User::factory()->create([
            'name' => 'Greg',
            'email' => 'greg@mail.com',
            'password' => Hash::make('password'),
        ]);

        // ✅ CHANGED: Create directories first and store them
        $directories = Directory::factory(10)->create();

        // ✅ CHANGED: Create Section A and Section B for each directory
        $sections = collect();
        foreach ($directories as $directory) {
            $sections = $sections->merge([
                Section::create([
                    'name' => 'Section A',
                    'directory_id' => $directory->id,
                ]),
                Section::create([
                    'name' => 'Section B',
                    'directory_id' => $directory->id,
                ]),
            ]);
        }

        // ✅ CHANGED: Create students using existing directories and sections
        Student::factory(50)->create([
            'directory_id' => fn() => $directories->random()->id,
            'section_id' => fn() => $sections->random()->id,
        ]);
    }
}