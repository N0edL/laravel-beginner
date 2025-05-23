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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <x-toast />
    <body class="font-sans antialiased dark:[color-scheme:dark]"
        x-data="{
            sidebarOpen: JSON.parse(localStorage.getItem('sidebarOpen')) ?? (window.innerWidth >= 768),
            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
            }
        }"
        x-init="
            $watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', JSON.stringify(value)));
            window.addEventListener('resize', () => {
                if(window.innerWidth < 768) sidebarOpen = false;
                else sidebarOpen = true;
                localStorage.setItem('sidebarOpen', JSON.stringify(sidebarOpen));
            });
        ">
        <div
            class="min-h-screen bg-neutral-100 dark:bg-neutral-900 flex"
            x-cloak
            x-init="$el.classList.remove('hidden')"
        >
            {{-- Sidebar --}}
            <aside class="w-64 bg-white dark:bg-neutral-800 shadow flex flex-col transform transition-transform duration-300"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">
                {{-- Logo --}}
                <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                    <div class="shrink-0 flex items-center justify-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-neutral-100" />
                        </a>
                    </div>
                    <div class="mt-2 justify-center text-center">
                        <p class="text-sm text-neutral-400">
                            {{ __( config('app.description', 'No description found!') ) }}
                        </p>
                    </div>
                </div>
                {{-- Navigation --}}
                <nav class="flex-1 p-4">
                    @include('layouts.navigation')
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-0' : '-ml-64'">
                {{-- Hotbar --}}
                <div class="bg-white dark:bg-neutral-800 shadow px-6 py-3 flex justify-between gap-2 items-center">
                    <button class="p-2 rounded hover:bg-neutral-200 dark:hover:bg-neutral-700 transition text-white flex justify-center items-center"
                        @click="toggleSidebar()"
                        aria-label="Toggle sidebar">
                        {{-- Hamburger Icon --}}
                        <i
                            x-show="!sidebarOpen"
                            x-cloak
                            class="fas fa-bars transition-transform duration-300 transform h"
                            x-bind:class="{'rotate-90': sidebarOpen}">
                        </i>
                        {{-- Close Icon --}}
                        <i
                            x-show="sidebarOpen"
                            x-cloak
                            class="fas fa-times transition-transform duration-300 transform"
                            x-bind:class="{'-rotate-90': !sidebarOpen}">
                        </i>
                    </button>
                    {{-- Page Label --}}
                    <h1 class="text-md font-medium text-neutral-300 text-center flex-1">
                        {{ $header }}
                    </h1>
                    {{-- Fullscreen Button --}}
                    <button class="p-2 rounded hover:bg-neutral-200 dark:hover:bg-neutral-700 transition text-white justify-center items-center hidden md:flex"
                        x-data="{ fs: false }"
                        x-init="document.addEventListener('fullscreenchange',()=>fs=!!document.fullscreenElement)"
                        @click="fs ? document.exitFullscreen() : document.documentElement.requestFullscreen()"
                        aria-label="Toggle fullscreen">
                        <i :class="fs ? 'fas fa-compress' : 'fas fa-expand'"></i>
                    </button>
                    <span></span>
                    {{-- User Profile --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-neutral-700 dark:text-neutral-200 hover:text-neutral-900 dark:hover:text-neutral-100">
                            <span class="inline-flex items-center justify-center w-9 h-7 rounded-full border-2 border-neutral-300 dark:border-neutral-600">
                                <i class="fa-solid text-sm fa-user w-full"></i>
                            </span>
                            <span class="ml-2 text-sm font-medium hidden md:inline">{{ Auth::user()->name }}</span>
                            <i
                                :class="open ? 'rotate-180' : 'rotate-0'"
                                class="fa-solid ml-2 fa-chevron-down transition-all duration-300 text-xs">
                            </i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded shadow-lg z-50"
                            x-show="open"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-20"
                            @click.away="open = false">
                            <div class="px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200">
                                <p class="font-medium">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="border-t border-neutral-200 dark:border-neutral-700"></div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-700">
                                {{ __("Profile") }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 rounded-b hover:bg-red-100 dark:hover:bg-red-500 hover:text-red-600 dark:hover:text-red-100 transition-colors duration-150">
                                    {{ __("Logout") }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Page Content --}}
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        {{-- Scripts --}}
        @livewireScripts

    </body>
</html>
