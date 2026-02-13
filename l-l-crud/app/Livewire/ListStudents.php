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
    public $selectedStudentIds = []; // wire:model.live="selectedStudentIds" in the checkbox field

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

    // delete students method
    public function deleteStudents()
    {
        Student::whereIn('id', $this->selectedStudentIds)->delete();
        $this->dispatch('toast', type: 'success', message: 'Students deleted successfully');
        // reset selected student ids to ensure checkbox state updates
        $this->selectedStudentIds = [];
        // reset page
        $this->resetPage();
    }

    // sort by column method
    public function sortByColumn($column, $direction)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
        $this->resetPage(); // Reset pagination when sorting changes
    }

    // toggle select all checkboxes
    public function toggleSelectAll()
    {
        // Get current page students
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
        
        $currentPageIds = $students->pluck('id')->toArray();
        
        // Check if all current page items are selected
        $allSelected = !empty($currentPageIds) && count(array_intersect($currentPageIds, $this->selectedStudentIds)) === count($currentPageIds);
        
        if ($allSelected) {
            // Deselect all current page items
            $this->selectedStudentIds = array_values(array_diff($this->selectedStudentIds, $currentPageIds));
        } else {
            // Select all current page items (merge without duplicates)
            $this->selectedStudentIds = array_values(array_unique(array_merge($this->selectedStudentIds, $currentPageIds)));
        }
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
