<x-app-layout>
    <x-slot name="header">
        {{ __('Portfolio - Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('message'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 mb-4"
                    role="alert"
                >
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue/80 to-sky-600 shadow-lg rounded-xl p-8 flex items-center gap-4 mb-6 fade-in-item" style="animation-delay: 0.1s;">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name ?? 'User' }}!</h2>
                    <p class="text-white/80">Here’s an overview of your portfolio projects.</p>
                </div>
                <img src="https://avatars.githubusercontent.com/u/88205753" alt="Avatar" class="w-16 h-16 rounded-full border-4 border-white/20 ml-auto hidden md:block">
            </div>
            <!-- Portfolio Overview -->
            @livewire('admin-stats')


            <!-- Projects Table -->
            <livewire:projects-tabel />
        </div>
    </div>
</x-app-layout>
