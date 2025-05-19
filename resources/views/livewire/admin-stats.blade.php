<!-- Stats Cards -->
<div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.2s;">
        <div class="text-blue text-2xl mb-2">
            <i class="fa-solid fa-diagram-project"></i>
        </div>
        <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-1">
            {{ $totalProjects ?? 12 }}
        </div>
        <div class="text-neutral-500 dark:text-neutral-400 text-center">Total Projects</div>
    </div>
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.3s;">
        <div class="text-green text-2xl mb-2">
            <i class="fa-solid fa-list-check"></i>
        </div>
        <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-1">
            {{ $activeProjects ?? 5 }}
        </div>
        <div class="text-neutral-500 dark:text-neutral-400 text-center">Active Projects</div>
    </div>
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 flex flex-col items-center fade-in-item" style="animation-delay: 0.4s;">
        <div class="text-yellow text-2xl mb-2">
            <i class="fa-solid fa-cubes"></i>
        </div>
        <div class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-1">
            {{ $totalSkills ?? 7 }}
        </div>
        <div class="text-neutral-500 dark:text-neutral-400 text-center">Total Skills</div>
    </div>
</div>
