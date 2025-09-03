<div>
    <div class="py-4 px-4 bg-white dark:bg-neutral-800 rounded-lg shadow-md fade-in-item" style="animation-delay: 0.4s;">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100">Projects</h2>
            <div class="flex space-x-2">
                <button wire:click="create" class="px-4 py-2 bg-gradient-to-r from-blue/80 to-sky-600 text-white rounded-md hover:bg-blue-700">
                    Add Project
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider cursor-pointer align-middle" wire:click="sortBy('name')">
                            <span class="flex items-center gap-1">
                                Name
                                @if($sortField === 'name')
                                    <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider align-middle">
                            <span class="flex items-center">Description</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider align-middle">
                            <span class="flex items-center">Tech Stack</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider cursor-pointer align-middle" wire:click="sortBy('due_date')">
                            <span class="flex items-center gap-1">
                                Date
                                @if($sortField === 'due_date')
                                    <span>{{ $sortDirection === 'desc' ? '↑' : '↓' }}</span>
                                @endif
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider align-middle">
                            <span class="flex items-center">Status</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-neutral-400 uppercase tracking-wider align-middle">
                            <span class="flex items-center justify-end">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-neutral-100">{{ $project->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 dark:text-neutral-400 truncate max-w-xs">{{ $project->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 dark:text-neutral-400">{{ $project->stack }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-neutral-400">
                                {{ $project->due_date ? date('M d, Y', strtotime($project->due_date)) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="inline-block text-xs font-medium rounded-full px-2 py-1
                                    {{ $project->active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-400' }}">
                                    {{ $project->active ? 'Active' : 'Hidden' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $project->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $project->id }})" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this project?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                No projects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 dark:text-neutral-200">
            {{ $projects->links() }}
        </div>
    </div>

    @if($isOpen)
        <div class="fixed z-50 inset-0 bg-gray-500 bg-opacity-75 dark:bg-neutral-800/75 flex items-center justify-center" wire:click.self="closeModal">
            <div class="bg-white dark:bg-neutral-800 rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
            <div class="px-6 py-4 bg-gray-100 dark:bg-neutral-700 border-b dark:border-neutral-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-neutral-100">
                {{ $projectId ? 'Edit Project' : 'Create New Project' }}
                </h3>
            </div>

            <form wire:submit.prevent="store">
                @csrf
                <div class="px-6 py-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Project Name</label>
                    <input type="text" id="name" wire:model="name"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    @error('name')
                    <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Description</label>
                    <textarea id="description" wire:model="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                    @error('description')
                    <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stack" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Tech Stack</label>
                    <textarea id="stack" wire:model="stack" rows="2"
                    placeholder="Laravel, Vue.js, Tailwind CSS, etc."
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                    @error('stack')
                    <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Date (Leave blank for today's date)</label>
                    <div class="relative">
                    <input
                        type="date"
                        id="due_date"
                        wire:model="due_date"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    />
                    </div>
                    @error('due_date')
                    <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Project URL (Leave blank for none)</label>
                    <input type="text" id="url" wire:model="url"
                    placeholder="https://example.com"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    @error('url')
                    <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                    <input type="checkbox" wire:model="active" class="rounded border-gray-300 dark:border-neutral-600 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <span class="ml-2 text-sm text-gray-700 dark:text-neutral-300">Show on portfolio</span>
                    </label>
                </div>
                </div>

                <div class="px-6 py-4 bg-gray-100 dark:bg-neutral-700 flex justify-end">
                <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 dark:bg-neutral-600 dark:text-neutral-200 rounded-md mr-2 hover:bg-gray-300 dark:hover:bg-neutral-500">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Save
                </button>
                </div>
            </form>
            </div>
        </div>
    @endif
</div>
