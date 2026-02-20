<?php

namespace App\Livewire\Files;

use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    #[Validate('required|mimes:jpeg,jpg,png,gif,webp,mp4,mov,avi,mkv|max:2048', 
        message: [
            'required' => 'Please select a file to upload.',
            'mimes' => 'Only images (jpeg, jpg, png, gif, webp) and videos (mp4, mov, avi, mkv) are allowed.',
            'max' => 'File is too big. Maximum file size is 2MB.',
        ]
    )]
    public $file = null;
    
    public $activeTab = 'all';
    public $uploadSuccess = false;


    public function mount()
    {
        $this->file = null;
        $this->uploadSuccess = false;
    }

    // This is used to validate the file when it is uploaded livewire hook is triggered
    public function updatedFile()
    {
        // Reset upload success when a new file is selected
        $this->uploadSuccess = false;

    }

    public function saveFile()
    {
        // Validate will automatically use the #[Validate] attributes
        // If validation fails, Livewire will automatically display the error messages
        // from the attribute messages via @error('file') directive
        $this->validate();

        // Determine file type
        $type = $this->getFileType($this->file);
        
        // Store the file
        $path = $this->file->store('files', 'public');
        
        // Create database record
        File::create([
            'user_id' => Auth::id(),
            'name' => $this->file->getClientOriginalName(),
            'type' => $type,
            'path' => $path,
        ]);
        
        // Set upload success flag
        $this->uploadSuccess = true;
        
        // Clear the file after upload
        $this->reset('file');
    }

    private function getFileType($file)
    {
        $mimeType = $file->getMimeType();
        
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }
        
        // Fallback based on extension
        $extension = strtolower($file->getClientOriginalExtension());
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv'];
        
        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        }
        
        return 'image'; // Default fallback
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function getUserFilesProperty()
    {
        $query = Auth::user()->files()->latest();

        if ($this->activeTab === 'images') {
            $query->where('type', 'image');
        } elseif ($this->activeTab === 'videos') {
            $query->where('type', 'video');
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.files.file-uploader');
    }
}
