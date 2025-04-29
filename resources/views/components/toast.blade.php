<div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">

    @if(session()->has('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-20 opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-20 opacity-0"
        class="flex items-center max-w-xs p-4 text-green-800 border-t-4 border-green-400 bg-green-50 dark:text-green-200 dark:bg-neutral-800 dark:border-green-600 rounded shadow">
        <i class="fa-solid fa-circle-check text-green-500 mr-3"></i>
        <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
        <button @click="show = false"
            class="ml-4 text-green-800 hover:text-green-600 dark:text-green-200 dark:hover:text-green-400">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    @if(session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-20 opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition transform duration-300"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-20 opacity-0"
            class="flex items-center max-w-xs p-4 text-red-800 border-t-4 border-red-400 bg-red-50 dark:text-red-200 dark:bg-neutral-800 dark:border-red-500 rounded shadow">
            <i class="fa-solid fa-circle-xmark text-red-400 mr-3"></i>
            <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
            <button @click="show = false"
                class="ml-4 text-red-800 hover:text-red-600 dark:text-red-200 dark:hover:text-red-400">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session()->has('info'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-20 opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition transform duration-300"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-20 opacity-0"
            class="flex items-center max-w-xs p-4 text-neutral-800 border-t-4 border-neutral-400 bg-neutral-50 dark:text-neutral-200 dark:bg-neutral-800 dark:border-neutral-500 rounded shadow">
            <i class="fa-solid fa-circle-info text-neutral-400 mr-3"></i>
            <span class="flex-1 text-sm font-medium">{{ session('info') }}</span>
            <button @click="show = false"
                class="ml-4 text-neutral-800 hover:text-neutral-600 dark:text-neutral-200 dark:hover:text-neutral-400">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif
</div>
