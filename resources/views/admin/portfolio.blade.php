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
            <!-- Portfolio Overview -->
            @livewire('admin-stats')


            <!-- Projects Table -->
            @livewire('projects-tabel')
        </div>
    </div>
</x-app-layout>
