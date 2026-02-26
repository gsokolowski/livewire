<?php

namespace App\Livewire\Chat\Pages;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Room;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RoomShow extends Component
{
    #[Layout('layouts.app')]

    public Room $room;

    public string $newMessage = '';

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    #[Computed]
    public function chatMessages()
    {
        return $this->room
            ->messages()
            ->with('user')
            ->oldest()
            ->limit(50)
            ->get();
    }

    public function sendMessage(): void
    {
        $this->validate([
            'newMessage' => ['required', 'string', 'max:65535'],
        ]);

        $message = Message::create([
            'room_id' => $this->room->id,
            'user_id' => auth()->id(),
            'message' => trim($this->newMessage),
        ]);

        $message->load('user');

        broadcast(new MessageSent($message));

        $this->newMessage = '';

        unset($this->chatMessages);

        $this->js('const el = document.getElementById("chat-messages"); if (el) el.scrollTo({ top: el.scrollHeight, behavior: "smooth" })');
    }

    public function render()
    {
        return view('livewire.chat.pages.room-show');
    }
}
