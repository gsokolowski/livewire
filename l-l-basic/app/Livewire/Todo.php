<?php

namespace App\Livewire;

use Livewire\Component;

class Todo extends Component
{
    // String property
    public $todo = '';
    
    // Array property with default value
    public $todos = [];

    // Method to add a todo
    public function addTodo()
    {
        // Check if the todo is not empty
        if (!empty($this->todo)) {
            $this->todos[] = $this->todo;
            $this->todo = ''; // Clear the input after adding
        }
    }

    // Method to remove a todo
    public function removeTodo($index)
    {
        // Remove the todo from the array
        unset($this->todos[$index]); 
        // Re-index the array
        $this->todos = array_values($this->todos); 
    }

    // Method to render the component
    public function render()
    {
        return view('livewire.todo');
    }
}