<?php

namespace Database\Factories;

use App\Models\Directory;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ✅ ADDED: Generate fake name and email data
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'directory_id' => Directory::factory(),
            'section_id' => Section::factory(),
        ];
    }
}