<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ListStudents extends Component
{
    // you need to add the layout to the component to use breeze layout
    #[Layout('layouts.app')] // layouts/app.blade.php

    public function render()
    {
        return view('livewire.list-students');
    }
}
