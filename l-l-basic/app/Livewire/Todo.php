<?php

namespace App\Livewire;

use Livewire\Component;

class Todo extends Component
{
    // String property
    public $todo = '';
    
    // Array property with default value
    public $todos = [];

    public function addTodo() // Remove the parameter
    {
        if (!empty($this->todo)) {
            $this->todos[] = $this->todo; // Use $this->todo property
            $this->todo = ''; // Clear the input after adding
        }
    }

    public function removeTodo($index)
    {
        unset($this->todos[$index]);
        $this->todos = array_values($this->todos); // Re-index array
    }

    public function render()
    {
        return view('livewire.todo');
    }
}