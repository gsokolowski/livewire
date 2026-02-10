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

    // delete student method
    public function deleteStudent($id)
    {
        Student::find($id)->delete();
        $this->dispatch('toast', type: 'success', message: 'Student deleted successfully');
        
    }

    public function render()
    {
        // ✅ CHANGED: Load students with relationships for better performance
        $students = Student::with(['directory', 'section'])->orderBy('id', 'desc')->paginate(10);

        return view('livewire.list-students', [
            'students' => $students,
        ]);
    }
}
