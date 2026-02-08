<div>
    <h1>Todo List</h1>
    <ul>
        @foreach ($todos as $todo)
            <li>{{ $todo }} <button wire:click="removeTodo({{ $loop->index }})">Remove</button></li>
        @endforeach
    </ul>
    <input type="text" wire:model="todo" placeholder="Add a new todo">
    <button wire:click="addTodo">Add</button>
</div>