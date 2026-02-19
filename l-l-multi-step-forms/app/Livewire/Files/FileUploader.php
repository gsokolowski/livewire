<?php

namespace App\Livewire\Files;

use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $file = null;
    public $activeTab = 'all';
    public $uploadSuccess = false;

    protected $rules = [
        'file' => 'required|mimes:jpeg,jpg,png,gif,webp,mp4,mov,avi,mkv|max:10240',
    ];

    protected $messages = [
        'file.mimes' => 'Only images (jpeg, jpg, png, gif, webp) and videos (mp4, mov, avi, mkv) are allowed.',
        'file.max' => 'File must not exceed 10MB.',
    ];

    public function mount()
    {
        $this->file = null;
        $this->uploadSuccess = false;
    }

    public function updatedFile()
    {
        // Reset upload success when a new file is selected
        $this->uploadSuccess = false;
    }

    public function saveFile()
    {
        // Check if file exists first
        if (!$this->file) {
            session()->flash('error', 'No file selected.');
            return;
        }

        // Validate file
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset('file');
            throw $e;
        }

        try {
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
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
            $this->reset('file');
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
