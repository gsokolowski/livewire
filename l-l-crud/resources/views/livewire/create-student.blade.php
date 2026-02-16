<div>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', (event) => {
                const type = event.type || 'success';
                const message = event.message || 'Operation completed';
                
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                
                switch(type) {
                    case 'success':
                        Toast.fire({ icon: 'success', title: message });
                        break;
                    case 'error':
                        Toast.fire({ icon: 'error', title: message });
                        break;
                    case 'warning':
                        Toast.fire({ icon: 'warning', title: message });
                        break;
                    case 'info':
                        Toast.fire({ icon: 'info', title: message });
                        break;
                    default:
                        Toast.fire({ icon: 'success', title: message });
                }
            });
        });
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <!-- create student form -->
                    <form wire:submit="createStudent">
                        @csrf
                        @method('POST')
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Student Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new student.
                                    </p>
                                </div>
    
    
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" id="name" wire:model="name"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror" />
                                        <p class="mt-1 text-sm text-red-500">
                                            @error('name') <span class="error">{{ $message }}</span> @enderror 
                                        </p>
                                    </div>
    
    
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            Address</label>
                                        <input type="email" id="email" autocomplete="email" wire:model="email"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror" />
                                        <p class="mt-1 text-sm text-red-500">
                                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                                        </p>
                                    </div>
    
    
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="directory_id" class="block text-sm font-medium text-gray-700">Directory</label>
                                        <select id="directory_id" wire:model.live="directory_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('directory_id') text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror">
                                            <option value="">Select a Directory</option>
                                            @foreach($directories as $directory)
                                                <option value="{{ $directory->id }}">{{ $directory->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mt-1 text-sm text-red-500">
                                            @error('directory_id') <span class="error">{{ $message }}</span> @enderror 
                                        </p>
                                    </div>
    
    
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="section_id"
                                            class="block text-sm font-medium text-gray-700">Section</label>
                                        <select id="section_id" wire:model="section_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('section_id') text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror">
                                            <option value="">
                                                Select a Section
                                            </option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }} of {{ $section->directory->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mt-1 text-sm text-red-500">
                                            @error('section_id') <span class="error">{{ $message }}</span> @enderror 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a wire:navigate href="{{ route('students.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                    Cancel
                                </a>
                                <button type="submit" 
                                    class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center items-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span wire:loading.remove wire:target="createStudent">Save</span>
                                    <span wire:loading wire:target="createStudent" class="flex items-center">
                                        Saving...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
