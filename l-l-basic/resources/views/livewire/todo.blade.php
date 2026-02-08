<div class="max-w-md mx-auto p-6 bg-gray-100 rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-center">Todo List</h1>
    
    <div class="space-y-4">
        <ul class="space-y-2">
            @foreach ($todos as $todo)
                <li class="flex items-center justify-between bg-white p-3 rounded shadow">
                    <span>{{ $todo }}</span>
                    <button 
                        wire:click="removeTodo({{ $loop->index }})"
                        class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded transition-colors"
                        title="Delete todo"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                </li>
            @endforeach
        </ul>
        
        
        <input class="w-full border rounded px-4 py-2"
        type="text" 
        wire:model="todo"
        placeholder="Add a new todo"
        wire:keydown.enter="addTodo"
        >
        <button wire:click="addTodo" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
    </div>
</div>