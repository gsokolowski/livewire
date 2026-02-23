<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        Post::factory(250)->create(function () use ($users) {
            return [
                'user_id' => $users->random()->id,
            ];
        });
    }
}
