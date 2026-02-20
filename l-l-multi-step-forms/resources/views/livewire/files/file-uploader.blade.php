<div>
    {{-- Upload Section --}}
    <div class="mb-8">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Upload Files</h3>
        
        <div class="space-y-6">
            <div>
                <x-input-label for="file-upload" :value="__('Select Files')" />
                <div 
                    x-data="{ 
                        isDragging: false,
                        handleDrop(e) {
                            this.isDragging = false;
                            e.preventDefault();
                            e.stopPropagation();
                            const files = Array.from(e.dataTransfer.files);
                            if (files.length > 0) {
                                const input = document.getElementById('file-upload');
                                // Clear first to ensure clean state
                                input.value = '';
                                // Set all files
                                const dataTransfer = new DataTransfer();
                                files.forEach(file => {
                                    dataTransfer.items.add(file);
                                });
                                input.files = dataTransfer.files;
                                // Trigger input event first, then change event for Livewire
                                input.dispatchEvent(new Event('input', { bubbles: true }));
                                setTimeout(() => {
                                    input.dispatchEvent(new Event('change', { bubbles: true }));
                                }, 100);
                            }
                        },
                        handleDragOver(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            this.isDragging = true;
                        },
                        handleDragLeave(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            this.isDragging = false;
                        }
                    }"
                    @drop.prevent="handleDrop($event)"
                    @dragover.prevent="handleDragOver($event)"
                    @dragleave.prevent="handleDragLeave($event)"
                    :class="{ 'border-indigo-500 bg-indigo-50': isDragging }"
                    class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors"
                >
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-4h-4m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="mt-4">
                        <label for="file-upload" class="cursor-pointer">
                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                Drag and drop files here, or
                            </span>
                            <span class="mt-1 block text-sm text-indigo-600 hover:text-indigo-500">
                                click to select files
                            </span>
                        </label>
                        <input 
                            id="file-upload" 
                            type="file" 
                            multiple
                            wire:model="files"
                            wire:loading.attr="disabled"
                            wire:target="files"
                            accept="image/*,video/*"
                            class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        />
                    </div>
                    <p class="mt-2 text-xs text-gray-500">
                        Images (JPEG, PNG, GIF, WebP) and Videos (MP4, MOV, AVI, MKV) up to 2MB each
                    </p>
                </div>
                {{-- Validation Errors --}}
                @if ($errors->has('files.*'))
                    <x-input-error class="mt-2" :messages="$errors->get('files.*')" />
                @endif
                @foreach ($errors->all() as $error)
                    @if (str_contains($error, 'files'))
                        <x-input-error class="mt-2" :messages="[$error]" />
                    @endif
                @endforeach
            </div>

            {{-- Selected Files Preview --}}
            @if (count($files) > 0)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Selected files ({{ count($files) }}):</p>
                    <div class="space-y-2">
                        @foreach ($files as $index => $file)
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                                <div class="flex-1">
                                    <span class="text-sm text-gray-700">
                                        {{ $file->getClientOriginalName() }}
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">
                                        ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                    </span>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="removeFile({{ $index }})"
                                    class="ml-2 text-red-600 hover:text-red-800"
                                    title="Remove file"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            @if (str_starts_with($file->getMimeType(), 'image/'))
                                <div class="mt-1 mb-2">
                                    <div class="bg-gray-50 rounded-md p-2">
                                        <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="h-32 w-auto object-cover rounded-md">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Upload Button - Only show when files are selected --}}
            @if (count($files) > 0)
                <div class="flex items-center justify-end mt-4">
                    <button 
                        type="button"
                        wire:click="saveFile"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-100 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove wire:target="saveFile">Upload Files ({{ count($files) }})</span>
                        <span wire:loading wire:target="saveFile" style="display: none;">Uploading...</span>
                    </button>
                </div>
            @endif

            {{-- Progress Bar - Only show when user clicks upload button and upload is in progress (after clicking Upload File) --}}
            <div 
                wire:loading.class="block"
                wire:loading.class.remove="hidden"
                wire:target="saveFile"
                class="mt-4 hidden" 
            >
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Uploading {{ count($files) }} file(s)...</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div 
                        class="bg-green-500 h-2.5 rounded-full transition-all duration-2000"
                        x-data="{ progress: 0 }"
                        x-init="
                            progress = 0;
                            let interval = setInterval(() => {
                                progress = Math.min(progress + 3, 95);
                                if (progress >= 95) clearInterval(interval);
                            }, 100);
                        "
                        :style="'width: ' + progress + '%'"
                    ></div>
                </div>
            </div>

            {{-- Success Message - Show after upload completes, in place of progress bar --}}
            @if ($uploadSuccess)
                <div class="mt-4">
                    <div class="flex items-center justify-center mb-2">
                        <span 
                            class="text-sm font-medium text-green-800"
                            x-data="{ show: true }"
                            x-init="
                                setTimeout(() => {
                                    show = false;
                                    $wire.uploadSuccess = false;
                                }, 5000);
                            "
                            x-show="show"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                        >
                            {{ $uploadedCount }} file(s) uploaded successfully!
                        </span>
                    </div>
                </div>
            @endif
    </div>

    {{-- File List with Tabs --}}
    <div>
        <h3 class="text-lg font-medium text-gray-900 mb-4 mt-4">Your Files</h3>
        
        {{-- Tabs --}}
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button
                    wire:click="setActiveTab('all')"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'all' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    All Files
                </button>
                <button
                    wire:click="setActiveTab('images')"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'images' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    Images
                </button>
                <button
                    wire:click="setActiveTab('videos')"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'videos' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    Videos
                </button>
            </nav>
        </div>

        {{-- File List --}}
        @if ($this->userFiles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Uploaded
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($this->userFiles as $file)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $file->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($file->type === 'image')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Image
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Video
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $file->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No files</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by uploading your first file.</p>
            </div>
        @endif
    </div>
</div>
