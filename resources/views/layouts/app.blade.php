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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body
        class="font-sans antialiased"
        x-data="{ sidebarOpen: window.innerWidth >= 768 }"
        x-init="$watch('sidebarOpen', value => {}); window.addEventListener('resize', () => { if(window.innerWidth < 768) sidebarOpen = false; else sidebarOpen = true; })"
        >
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            <!-- Sidebar -->
            <aside
                class="w-64 bg-white dark:bg-gray-800 shadow flex flex-col transform transition-transform duration-300"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
            >
                <!-- Logo -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <!-- Header -->
                @isset($header)
                    <header class="bg-gray-50 dark:bg-gray-700 p-4 border-b border-gray-200 dark:border-gray-700">
                        {{ $header }}
                    </header>
                @endisset
                <!-- Navigation -->
                <nav class="flex-1 p-4">
                    @include('layouts.navigation')
                </nav>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-0' : '-ml-64'">
                <!-- Hotbar -->
                <div
                    class="bg-white dark:bg-gray-800 shadow px-6 py-3 flex items-center space-x-4">
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition text-white"
                        aria-label="Toggle sidebar"
                        >
                        <!-- Hamburger Icon -->
                        <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close Icon -->
                        <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Page Content -->
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Scripts -->
        @livewireScripts
    </body>
</html>
