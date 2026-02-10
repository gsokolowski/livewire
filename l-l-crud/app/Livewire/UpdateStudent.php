<?php

namespace App\Livewire;

use App\Models\Directory;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithValidation;

class UpdateStudent extends Component
{
    #[Layout('layouts.app')] // layouts/app.blade.php

    public $student;

    // properties bind with form fields
    public $name;
    public $email;
    public $directory_id; // to watch for sections dropdown dependent on directory
    public $section_id;

    // properties for sections dropdown dependent on directory
    public $sections = [];
    public $directories = [];

    public function mount($student)
    {
        // ✅ CHANGED: Load student with relationships
        $this->student = Student::with(['directory', 'section'])->findOrFail($student);
        
        // ✅ ADDED: Pre-populate form properties from the student
        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->directory_id = $this->student->directory_id;
        $this->section_id = $this->student->section_id;
        
        // ✅ ADDED: Load all directories
        $this->directories = Directory::all();
        
        // ✅ ADDED: Load sections for the student's directory
        $this->sections = Section::where('directory_id', $this->directory_id)->get();
    }

    // ✅ ADDED: when directory_id is updated, sections dropdown is updated
    public function updatedDirectoryId($value) // this is a livewire event requires wire:model.live directive in the form field
    {
        // get sections for the selected directory
        $this->sections = Section::where('directory_id', $value)->get();
        // reset section_id to null to avoid duplicate sections
        $this->section_id = null;
        $this->reset('section_id');
    }

    // ✅ ADDED: Update student method
    public function updateStudent()
    {
        // validate form fields (email unique rule should exclude current student)
        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:students,email,' . $this->student->id,
            'directory_id' => 'required|exists:directories,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        // update student in database
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'directory_id' => $this->directory_id,
            'section_id' => $this->section_id,
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Student updated successfully'
        ]);
        
        return $this->redirect(route('students.index'), navigate: true);

    }

    public function render()
    {
        return view('livewire.update-student');
    }
}
