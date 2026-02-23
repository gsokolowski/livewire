<?php

namespace App\Livewire;

use App\Models\Directory;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithValidation;

class CreateStudent extends Component
{
    #[Layout('layouts.app')] // load the layouts/app.blade.php file

    // properties bind with form fields
    public $name;
    public $email;
    public $directory_id; // to watch for sections dropdown dependent on directory
    public $section_id;

    // properties for sections dropdown dependent on directory
    public $sections = [];
    public $directories = [];

    public function createStudent()
    {
        // validate form fields
        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:students,email',
            'directory_id' => 'required|exists:directories,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        // create student in database
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'directory_id' => $this->directory_id,
            'section_id' => $this->section_id,
        ]);
        
        // dispatch toast notification flash becouse you need to redirect to the list students page
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Student created successfully'
        ]);

        return $this->redirect(route('students.index'), navigate: true);
    }
    // when directory_id is updated, sections dropdown is updated
    public function updatedDirectoryId($value) // this is a livewire event requires wire:model.live directive in the form field
    {
        // get sections for the selected directory with directory relationship eager loaded
        $this->sections = Section::with('directory')->where('directory_id', $value)->get();
        // reset section_id to null to avoid duplicate sections
        $this->section_id = null;
        $this->reset('section_id');
    }

    // ✅ ADDED: mount() is called only once when component is initialized
    public function mount()
    {
        $this->directories = Directory::all();
    }

    public function render()
    {
        return view('livewire.create-student');
    }
}
