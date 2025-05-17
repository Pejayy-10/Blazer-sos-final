<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Blazer SOS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="antialiased bg-gradient-to-br from-background-dark to-primary-dark text-text-light">
    <!-- Background design elements -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    
    <!-- Page loading indicator -->
    <div id="pageLoader" class="fixed inset-0 z-50 flex items-center justify-center bg-background-dark transition-opacity duration-500">
        <div class="text-center">
            <div class="w-12 h-12 border-4 border-t-primary border-primary/30 rounded-full animate-spin"></div>
            <p class="mt-4 text-accent font-medium">Loading amazing experience...</p>
        </div>
    </div>
    
    <!-- Navigation -->
    @include('components.ui.navigation.main-navbar')
    
    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    @include('components.ui.navigation.main-footer')
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Page scripts -->
    <script>
        // Loading screen
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('pageLoader').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('pageLoader').style.display = 'none';
                }, 500);
            }, 800);
        });
    </script>
    
    @stack('scripts')
</body>
</html> 