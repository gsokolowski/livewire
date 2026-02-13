<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListStudents extends Component
{
    use WithPagination;
    // you need to add the layout to the component to use breeze layout
    #[Layout('layouts.app')] // layouts/app.blade.php

    // property for search input
    public $search = ''; // wire:model.live="search" in the input field

    // properties for sorting
    public $sortColumn = 'id'; // Current column being sorted
    public $sortDirection = 'desc'; // Current sort direction ('asc' or 'desc')

    // livewire hook method - Automatically called when $search changes 
    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination when search input is changed
    }

    // check for session flash and dispatch toast on mount
    public function mount()
    {
        if (session()->has('toast')) {
            $toast = session('toast');
            $this->dispatch('toast', type: $toast['type'], message: $toast['message']);
        }
    }

    // delete student method
    public function deleteStudent($id)
    {
        Student::find($id)->delete();
        // dispatch toast notification not flash becouse you need to stay on the list students page
        $this->dispatch('toast', type: 'success', message: 'Student deleted successfully');
        
    }

    // sort by column method
    public function sortByColumn($column, $direction)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
        $this->resetPage(); // Reset pagination when sorting changes
    }

    public function render()
    {
        // Load students with relationships, search filter, sorting, and pagination
        $students = Student::with(['directory', 'section'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('directory', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('section', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.list-students', [
            'students' => $students,
        ]);
    }
}
