<x-app-layout>
    <x-slot name="header">
        {{ __('Home') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Dashboard - Home') }}
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue/80 to-sky-600 shadow-lg rounded-xl p-4 md:p-8 flex flex-col md:flex-row items-center gap-4 mb-6 fade-in-item" style="animation-delay: 0.1s;">
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-xl md:text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name ?? 'User' }}!</h2>
                    <p class="text-white/80">This is your admin dashboard. Here you can manage your portfolio, projects, and more.</p>
                </div>
                <img src="https://avatars.githubusercontent.com/u/88205753" alt="Avatar" class="w-12 h-12 md:w-16 md:h-16 rounded-full border-4 border-white/20 mt-4 md:mt-0 md:ml-auto hidden sm:block">
            </div>
    </div>
</x-app-layout>
