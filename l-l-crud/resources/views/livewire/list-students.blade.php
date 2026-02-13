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

        // ✅ ADDED: Confirmation dialog for bulk delete using SweetAlert2
        function confirmBulkDelete() {
            const selectedCount = @this.selectedStudentIds.length;
            
            Swal.fire({
                title: 'Are you sure?',
                text: `Are you sure you want to delete ${selectedCount} student(s)?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to trigger wire:submit="deleteStudents"
                    const form = document.getElementById('bulk-delete-form');
                    if (form) {
                        form.requestSubmit();
                    }
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
                    <div class="flex flex-col justify-between sm:flex-row mt-4 mb-4">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                                <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                            </div>
                            <input type="text" placeholder="Search students data..." id="search" wire:model.live.debounce.500ms="search"
                                class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                        <div x-show="$wire.selectedStudentIds.length > 0"
                            class="flex flex-col sm:flex-row gap-2 sm:justify-end col-span-5">
                            <div class="flex flex-row-reverse justify-end sm:justify-start sm:flex-row gap-2">
                                <div class="flex items-center gap-1 text-md text-gray-600">
                                    <!-- count of selected student ids does not require wire:model.live directive on checkbox field. SO you save on network traffic. -->
                                    <span x-text="$wire.selectedStudentIds.length"></span>
                                    <span>selected</span>
                                </div>
                                <div class="flex items-center px-3">
                                    <!-- vertical line -->
                                    <div class="h-[75%] w-[1px] bg-gray-300"></div>
                                </div>                                
                                <form id="bulk-delete-form" wire:submit="deleteStudents">
                                    <button type="button"
                                        onclick="confirmBulkDelete()"
                                        class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-md text-gray-700 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-75">
                                        <x-heroicon-o-trash class="w-5 h-5" />
                                        <span wire:loading.remove wire:target="deleteStudents">Delete Students</span>
                                        <span wire:loading wire:target="deleteStudents" class="flex items-center">
                                            Deleting...
                                        </span>
                                    </button>
                                </form>
                                <button wire:click="exportSelected"
                                    class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-md text-gray-700 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-75">
                                    <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                                    <span wire:loading.remove wire:target="exportSelected">Export</span>
                                    <span wire:loading wire:target="exportSelected" class="flex items-center">
                                        Exporting...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
    
                    <div class="flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
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
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <input type="checkbox" 
                                                        wire:click="toggleSelectAll"
                                                        wire:key="select-all-{{ count($selectedStudentIds) }}-{{ $students->count() }}"
                                                        class="form-checkbox h-4 w-4 text-indigo-600"
                                                        @if(count($selectedStudentIds) === $students->count() && $students->count() > 0) checked @endif>
                                                </th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <span>ID</span>
                                                        <button wire:click="sortByColumn('id', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <button wire:click="sortByColumn('id', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <span>Name</span>
                                                        <button wire:click="sortByColumn('name', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <button wire:click="sortByColumn('name', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <span>Email</span>
                                                        <button wire:click="sortByColumn('email', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
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
                                                    <div class="flex items-center gap-1 cursor-pointer">
                                                        <span>Created At</span>
                                                        <button wire:click="sortByColumn('created_at', 'asc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                        </button>
                                                        <button wire:click="sortByColumn('created_at', 'desc')" 
                                                            class="p-0.5 rounded text-gray-700">
                                                            <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @if($students->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="px-3 py-4 text-sm text-gray-500 text-center">
                                                        No students found.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($students as $student)
                                                    <tr>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            <input type="checkbox" wire:model="selectedStudentIds" value="{{ $student->id }}" class="form-checkbox h-4 w-4 text-indigo-600">
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            {{ $student->id }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            {{ $student->name }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            {{ $student->email }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            {{ $student->directory->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            {{ $student->section->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
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
                                <!-- pagination links -->
                                <div class="mt-3 mb-3">Links {{ $students->links() }}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>