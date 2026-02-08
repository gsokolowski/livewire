<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire Counter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto text-center">
        <livewire:counter />
        <livewire:user-profile />
        <livewire:calculator />
    </div>
    
    @livewireScripts
</body>
</html>