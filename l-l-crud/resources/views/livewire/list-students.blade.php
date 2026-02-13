<div>
    @if(session('toast'))
    <script>
        // ✅ CHANGED: Use Livewire navigation event instead of DOMContentLoaded
        document.addEventListener('livewire:navigated', () => {
            const toast = @json(session('toast'));
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({ icon: toast.type, title: toast.message });
        });
        
        // Also check on initial load (for non-navigated visits)
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                const toast = @json(session('toast'));
                if (toast) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({ icon: toast.type, title: toast.message });
                }
            });
        } else {
            // Already loaded
            const toast = @json(session('toast'));
            if (toast) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                Toast.fire({ icon: toast.type, title: toast.message });
            }
        }
    </script>
    @endif
    <script>
        // ✅ ADDED: Confirmation dialog using SweetAlert2
        function confirmDelete(studentId, studentName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Are you sure you want to delete student: ${studentName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state for this specific button
                    const deleteText = document.getElementById('delete-text-' + studentId);
                    const deletingText = document.getElementById('deleting-text-' + studentId);
                    if (deleteText && deletingText) {
                        deleteText.style.display = 'none';
                        deletingText.style.display = 'inline-flex';
                    }
                    
                    // Call Livewire method to delete
                    @this.deleteStudent(studentId).then(() => {
                        // Hide loading state after deletion
                        if (deleteText && deletingText) {
                            deleteText.style.display = 'inline';
                            deletingText.style.display = 'none';
                        }
                    });
                }
            });
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="sm:flex sm:items-center mb-6">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Students
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Students.
                            </p>
                        </div>
    
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a wire:navigate href="{{ route('students.create') }}"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                Add Student
                            </a>
                        </div>
                    </div>  
                    <div class="flex flex-col justify-between sm:flex-row mt-6">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                                <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                            </div>
         
                            <input type="text" placeholder="Search students data..." id="search" wire:model.live.debounce.500ms="search"
                                class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
    
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <!-- pagination links -->
                                <div class="mt-5">Links {{ $students->links() }}</div>
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <!-- ✅ ADDED: Loading indicator for pagination in table area -->
                                    <div id="table-loading" wire:loading class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                                        <div class="flex flex-col items-center">
                                            <x-heroicon-o-arrow-path class="w-8 h-8 text-indigo-600 animate-spin mb-2" />
                                            <p class="text-sm text-gray-700">Loading...</p>
                                        </div>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <button wire:click="sortByColumn('id', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <span>ID</span>
                                                        <button wire:click="sortByColumn('id', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <button wire:click="sortByColumn('name', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <span>Name</span>
                                                        <button wire:click="sortByColumn('name', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <button wire:click="sortByColumn('email', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <span>Email</span>
                                                        <button wire:click="sortByColumn('email', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Directory
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Section
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Created At
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @if($students->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="px-3 py-4 text-sm text-gray-500 text-center">
                                                        No students found.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($students as $student)
                                                    <tr>
                                                        <td
                                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                            {{ $student->id }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                            {{ $student->name }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $student->email }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $student->directory->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $student->section->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {{ $student->created_at->diffForHumans() }}
                                                        </td>
                                        
                                                        <td
                                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                            <a href="{{ route('students.update', $student->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                                Edit
                                                            </a>
                                                            <button 
                                                                id="delete-btn-{{ $student->id }}"
                                                                onclick="confirmDelete({{ $student->id }}, '{{ $student->name }}')" 
                                                                class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                                <span id="delete-text-{{ $student->id }}">Delete</span>
                                                                <span id="deleting-text-{{ $student->id }}" style="display: none;" class="flex items-center">
                                                                    Deleting...
                                                                </span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-5">Links {{ $students->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>