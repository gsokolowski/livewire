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

    public $files = [];
    
    public $activeTab = 'all';
    public $uploadSuccess = false;
    public $uploadedCount = 0;

    public function mount()
    {
        $this->files = [];
        $this->uploadSuccess = false;
        $this->uploadedCount = 0;
    }

    // This is used to validate the files when they are uploaded livewire hook is triggered
    public function updatedFiles()
    {
        // Reset upload success when new files are selected
        $this->uploadSuccess = false;
        $this->uploadedCount = 0;
    }

    public function saveFile()
    {
        // Validate files array
        $this->validate([
            'files.*' => 'required|mimes:jpeg,jpg,png,gif,webp,mp4,mov,avi,mkv|max:2048',
        ], [
            'files.*.required' => 'Please select files to upload.',
            'files.*.mimes' => 'Only images (jpeg, jpg, png, gif, webp) and videos (mp4, mov, avi, mkv) are allowed.',
            'files.*.max' => 'File is too big. Maximum file size is 2MB.',
        ]);

        $uploadedCount = 0;

        // Loop through all files and save each one
        foreach ($this->files as $file) {
            // Determine file type
            $type = $this->getFileType($file);
            
            // Store the file
            $path = $file->store('files', 'public');
            
            // Create database record
            File::create([
                'user_id' => Auth::id(),
                'name' => $file->getClientOriginalName(),
                'type' => $type,
                'path' => $path,
            ]);
            
            $uploadedCount++;
        }
        
        // Set upload success flag and count
        $this->uploadSuccess = true;
        $this->uploadedCount = $uploadedCount;
        
        // Clear the files after upload
        $this->reset('files');
    }

    public function removeFile($index)
    {
        // Remove file from array at specified index
        if (isset($this->files[$index])) {
            unset($this->files[$index]);
            // Re-index array to maintain sequential keys
            $this->files = array_values($this->files);
        }
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
