<div class="space-y-2">
    <a href="{{ route('dashboard') }}"
        class="flex items-center px-4 py-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-700 transition text-neutral-700 dark:text-neutral-200 {{ request()->routeIs('dashboard') ? 'bg-neutral-200 dark:bg-neutral-900 font-semibold' : '' }}">
        <i class="fa-solid fa-gauge-high w-5 mr-3"></i>
        <span>Dashboard</span>
    </a>
</div>
