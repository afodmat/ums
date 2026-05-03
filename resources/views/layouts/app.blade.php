<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Alpine.js Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 overflow-hidden h-screen">
        
        <!-- Main container with fixed height and flex layout -->
        <div class="flex h-screen overflow-hidden">
            
            <!-- SIDEBAR - fixed height, independent scrolling -->
            @include('layouts.sidebar', ['activePage' => $activePage ?? 'dashboard'])

            <!-- MAIN AREA - full height with independent scrolling -->
            <div class="flex-1 flex flex-col overflow-hidden">
                
                <!-- NAVBAR - fixed at top -->
                @include('layouts.navigation')

                <!-- SCROLLABLE CONTENT AREA -->
                <div class="flex-1 overflow-y-auto">
                    
                    <!-- PAGE HEADER -->
                    @isset($header)
                        <header class="bg-white shadow sticky top-0 z-10">
                            <div class="px-6 py-4">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- PAGE CONTENT -->
                    <main class="p-6">
                        {{ $slot }}
                    </main>

                </div>

            </div>

        </div>

    </body>
</html>