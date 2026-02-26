<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room = Room::where('slug', 'livewire')->first();

        if (!$room) {
            $this->command->warn('Room "livewire" not found. Run RoomSeeder first.');

            return;
        }

        $users = User::limit(6)->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Run UserSeeder first.');

            return;
        }

        Message::factory(100)->create(function () use ($room, $users) {
            return [
                'room_id' => $room->id,
                'user_id' => $users->random()->id,
            ];
        });
    }
}
