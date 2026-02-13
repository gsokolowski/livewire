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

        // ✅ CHANGED: Create directories with names "Class {id}"
        $directories = collect();
        for ($i = 1; $i <= 10; $i++) {
            $directories->push(
                Directory::create([
                    'name' => "Class {$i}",
                ])
            );
        }

        // ✅ CHANGED: Create Section A and Section B for each directory and store sections by directory
        $sectionsByDirectory = collect();
        foreach ($directories as $directory) {
            $directorySections = [
                Section::create([
                    'name' => 'Section A',
                    'directory_id' => $directory->id,
                ]),
                Section::create([
                    'name' => 'Section B',
                    'directory_id' => $directory->id,
                ]),
            ];
            $sectionsByDirectory[$directory->id] = collect($directorySections);
        }

        // ✅ CHANGED: Create students ensuring section belongs to the selected directory
        Student::factory(1000)->create(function () use ($directories, $sectionsByDirectory) {
            // Pick a random directory
            $directory = $directories->random();
            
            // Pick a random section from that directory's sections
            $section = $sectionsByDirectory[$directory->id]->random();
            
            return [
                'directory_id' => $directory->id,
                'section_id' => $section->id,
            ];
        });
    }
}