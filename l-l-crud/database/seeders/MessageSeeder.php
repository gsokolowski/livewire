<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(6)->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Run UserSeeder first.');

            return;
        }

        Message::factory(100)->create(function () use ($users) {
            return [
                'room_id' => 1,
                'user_id' => $users->random()->id,
            ];
        });
    }
}
