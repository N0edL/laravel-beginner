<div class="space-y-2">
    <a href="{{ route('admin.index') }}"
        class="flex items-center px-4 py-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-700 transition text-neutral-700 dark:text-neutral-200 {{ request()->routeIs('admin.index') ? 'bg-neutral-200 dark:bg-neutral-900 font-semibold' : '' }}">
        <i class="fa-solid fa-house w-5 mr-3"></i>
        <span>Home</span>
    </a>
    <a href="{{ route('admin.portfolio') }}"
        class="flex items-center px-4 py-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-700 transition text-neutral-700 dark:text-neutral-200 {{ request()->routeIs('admin.portfolio') ? 'bg-neutral-200 dark:bg-neutral-900 font-semibold' : '' }}">
        <i class="fa-solid fa-sitemap w-5 mr-3"></i>
        <span>Portfolio</span>
    </a>
</div>
