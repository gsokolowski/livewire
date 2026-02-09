<div class="max-w-md mx-auto p-6 bg-green-100 rounded-lg" 
     x-data="{ 
         todos: ['Buy groceries', 'Finish project', 'Call mom'],
         todo: ''
     }">
    <h1 class="text-2xl font-bold mb-4 text-center">Todo List</h1>
    
    <div class="space-y-4">
        <ul class="space-y-2">
            <template x-for="(todo, index) in todos" :key="index">
                <li class="flex items-center justify-between bg-white p-3 rounded shadow">
                    <span x-text="todo"></span>
                    <button 
                        @click="todos.splice(index, 1)"
                        class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded transition-colors"
                        title="Delete todo"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                </li>
            </template>
        </ul>
        
        <form @submit.prevent="if(todo.trim()) { todos.push(todo.trim()); todo = ''; }">
            <input 
                class="w-full border rounded px-4 py-2 bg-amber-50"
                type="text" 
                x-model="todo"
                placeholder="Add a new todo"
                @keydown.enter.prevent="if(todo.trim()) { todos.push(todo.trim()); todo = ''; }"
            >
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mt-2">Add</button>
        </form>
    </div>
</div>