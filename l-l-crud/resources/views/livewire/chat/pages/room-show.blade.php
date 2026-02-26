<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div
    class="flex h-[calc(100vh-4rem)] w-full max-w-full overflow-hidden"
    data-room-id="{{ $room->id }}"
>
    {{-- Left Sidebar --}}
    <aside class="w-72 shrink-0 bg-slate-100 border-r border-slate-200 flex flex-col">
        <div class="p-4 bg-slate-200/80">
            <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ $room->name }}
            </h2>
        </div>

        <div class="flex-1 overflow-auto p-2">
            <div class="rounded-lg bg-slate-200/60 p-3 mb-2">
                <p class="font-medium text-slate-800">{{ $room->name }}</p>
                <p class="text-xs text-slate-500">Room</p>
                <p class="text-xs text-slate-600 mt-1">Now</p>
            </div>
        </div>

        <div class="p-3 border-t border-slate-200">
            <p class="text-xs font-medium text-slate-500 uppercase mb-2">My Account</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-medium shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-medium text-slate-800">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-slate-600">{{ '@' . Str::before(auth()->user()->email, '@') }}</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- Right Chat Area --}}
    <div class="flex-1 flex flex-col bg-white min-w-0">
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4">
            @foreach($this->chatMessages as $msg)
                @php($isMine = $msg->user_id === auth()->id())
                <div class="{{ $isMine ? 'flex justify-end' : 'flex justify-start' }}">
                    <div class="{{ $isMine ? 'order-2' : 'order-1' }}">
                        @if(!$isMine)
                            <p class="text-sm font-medium text-slate-600 mb-1">{{ $msg->user->name }}</p>
                        @endif
                        <div class="{{ $isMine ? 'bg-indigo-500 text-white rounded-2xl rounded-br-md px-4 py-2 max-w-md' : 'bg-gray-200 text-gray-800 rounded-2xl rounded-bl-md px-4 py-2 max-w-md' }}">
                            <span>{{ $msg->message }}</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">{{ $msg->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-4 border-t border-gray-200">
            <form wire:submit="sendMessage" class="flex gap-2">
                <input
                    type="text"
                    wire:model="newMessage"
                    placeholder="Type a message..."
                    class="flex-1 rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                />
                <button
                    type="submit"
                    class="shrink-0 w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center hover:bg-indigo-600 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
</div>

@script
<script>
    const scrollToBottom = () => {
        const el = document.getElementById('chat-messages');
        if (el) el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
    };

    const roomId = @js($room->id);
    if (window.Echo) {
        window.Echo.private('rooms.' + roomId)
            .listen('.MessageSent', () => {
                $wire.$refresh();
                setTimeout(scrollToBottom, 150);
            });
    }
</script>
@endscript
