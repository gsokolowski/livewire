<?php

namespace App\Livewire;

use Livewire\Component;

class UserProfile extends Component
{
    // String property
    public $name = 'John Doe';
    
    // Integer property
    public $age = 25;
    
    // Boolean property
    public $isActive = true;
    
    // Array property
    public $hobbies = ['Reading', 'Coding', 'Gaming'];
    
    // Property with default value
    public $email = '';
    
    // Method with parameter
    public function updateName($newName)
    {
        $this->name = $newName;
    }
    
    // Method that modifies multiple properties
    public function activate()
    {
        $this->isActive = true;
    }
    
    public function deactivate()
    {
        $this->isActive = false;
    }
    
    // Method that works with arrays
    public function addHobby($hobby)
    {
        $this->hobbies[] = $hobby;
    }
    
    // Computed property (using #[Computed] attribute in Livewire 3)
    public function getFullInfoProperty()
    {
        return "{$this->name} ({$this->age} years old)";
    }
    
    public function render()
    {
        return view('livewire.user-profile');
    }
}