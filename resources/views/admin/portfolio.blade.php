<x-app-layout>
    <x-slot name="header">
        {{ __('Portfolio - Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue/80 to-sky-600 shadow-lg rounded-xl p-8 flex items-center gap-4 mb-6 fade-in-item" style="animation-delay: 0.1s;">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name ?? 'User' }}!</h2>
                    <p class="text-white/80">Here’s an overview of your portfolio projects.</p>
                </div>
                <img src="https://avatars.githubusercontent.com/u/88205753" alt="Avatar" class="w-16 h-16 rounded-full border-4 border-white/20 ml-auto hidden md:block">
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.2s;">
                    <div class="text-blue text-3xl mb-2">
                        <svg class="w-8 h-8 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V10m0 0l-6 6m6-6l6 6"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                        {{ $totalProjects ?? 12 }}
                    </div>
                    <div class="text-neutral-500 dark:text-neutral-400">Total Projects</div>
                </div>
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.3s;">
                    <div class="text-green text-3xl mb-2">
                        <svg class="w-8 h-8 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                        {{ $activeProjects ?? 5 }}
                    </div>
                    <div class="text-neutral-500 dark:text-neutral-400">Active Projects</div>
                </div>
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.4s;">
                    <div class="text-yellow text-3xl mb-2">
                        <svg class="w-8 h-8 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-6-6m6 6l6-6"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                        {{ $totalSkills ?? 7 }}
                    </div>
                    <div class="text-neutral-500 dark:text-neutral-400">Total Skills</div>
                </div>
            </div>

            <!-- Projects Table -->
            @livewire('projects-tabel')
        </div>
    </div>
</x-app-layout>
