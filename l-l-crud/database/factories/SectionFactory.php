<?php

namespace Database\Factories;

use App\Models\Directory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ✅ ADDED: Generate fake section name and directory relationship
        return [
            'name' => ' Section '.fake()->randomElement(['A', 'B']),
            'directory_id' => Directory::factory(),
        ];
    }
}