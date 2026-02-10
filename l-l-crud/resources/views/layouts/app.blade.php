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