<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        @livewireScripts

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- ✅ ADDED: Global JavaScript functions for Livewire components -->
        <script>
            // Helper function to find Livewire component instance
            function getLivewireComponent() {
                // Try to find component by wire:id attribute
                const wireElement = document.querySelector('[wire\\:id]');
                if (wireElement) {
                    const wireId = wireElement.getAttribute('wire:id');
                    return Livewire.find(wireId);
                }
                // Fallback: try to find any Livewire component
                const allWireElements = document.querySelectorAll('[wire\\:id]');
                if (allWireElements.length > 0) {
                    const firstWireId = allWireElements[0].getAttribute('wire:id');
                    return Livewire.find(firstWireId);
                }
                return null;
            }

            // Confirmation dialog using SweetAlert2
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
                        
                        // Find Livewire component and call delete method
                        const component = getLivewireComponent();
                        if (component) {
                            component.deleteStudent(studentId).then(() => {
                                // Hide loading state after deletion
                                if (deleteText && deletingText) {
                                    deleteText.style.display = 'inline';
                                    deletingText.style.display = 'none';
                                }
                            });
                        }
                    }
                });
            }

            // Confirmation dialog for bulk delete using SweetAlert2
            function confirmBulkDelete() {
                const component = getLivewireComponent();
                if (!component) {
                    console.error('Livewire component not found');
                    return;
                }
                
                const selectedCount = component.selectedStudentIds ? component.selectedStudentIds.length : 0;
                
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
        
        <!-- ✅ ADDED: Global toast listener for all Livewire components -->
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('toast', (event) => {
                    // Use SweetAlert2 for notifications
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
                            Toast.fire({
                                icon: 'success',
                                title: message
                            });
                            break;
                        case 'error':
                            Toast.fire({
                                icon: 'error',
                                title: message
                            });
                            break;
                        case 'warning':
                            Toast.fire({
                                icon: 'warning',
                                title: message
                            });
                            break;
                        case 'info':
                            Toast.fire({
                                icon: 'info',
                                title: message
                            });
                            break;
                        default:
                            Toast.fire({
                                icon: 'success',
                                title: message
                            });
                    }
                });
            });
        </script>
    </body>
</html>