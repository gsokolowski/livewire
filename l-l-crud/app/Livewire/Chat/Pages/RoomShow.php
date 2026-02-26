<?php

namespace App\Livewire\Chat\Pages;

use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RoomShow extends Component
{
    #[Layout('layouts.app')] // load the layouts/app.blade.php file

    public Room $room;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.chat.pages.room-show', [
            'room' => $this->room,
        ]);
    }
}
