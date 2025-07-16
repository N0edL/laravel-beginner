<x-app-layout>
    <x-slot name="header">
        {{ __('Portfolio - Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                x-data="{ show: false, message: '' }"
                @flash-message.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
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
                <p x-text="message"></p>
            </div>

            <!-- Portfolio Overview -->
            @livewire('admin-stats')

            <!-- Projects Table -->
            @livewire('projects-tabel')

            <!-- AboutMe Form -->
            @livewire('aboutme-form')
        </div>
    </div>
</x-app-layout>
