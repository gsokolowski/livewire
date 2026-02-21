<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['image', 'video']);
        $extension = $type === 'image' 
            ? fake()->randomElement(['jpg', 'jpeg', 'png', 'gif', 'webp'])
            : fake()->randomElement(['mp4', 'mov', 'avi', 'mkv']);
        
        $name = fake()->word() . '.' . $extension;
        $path = 'files/' . fake()->uuid() . '_' . $name;

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'type' => $type,
            'path' => $path,
        ];
    }
}
