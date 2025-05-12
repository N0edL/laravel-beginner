<div>
    <div class="py-4 px-4 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Portfolio Projects</h2>
            <div class="flex space-x-2">
                <div class="flex items-center space-x-2">
                    <button wire:click="filterByActive('active')" class="px-3 py-1 text-sm {{ $activeFilter === 'active' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
                        Active
                    </button>
                    <button wire:click="filterByActive('inactive')" class="px-3 py-1 text-sm {{ $activeFilter === 'inactive' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
                        Hidden
                    </button>
                    <button wire:click="resetFilters" class="px-3 py-1 text-sm {{ $activeFilter === '' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-md">
                        All
                    </button>
                </div>
                <div>
                    <input wire:model.debounce.300ms="search" type="text" placeholder="Search projects..."
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                </div>
                <button wire:click="create" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Add Project
                </button>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">
                            Project Name
                            @if($sortField === 'name')
                                @if($sortDirection === 'asc')
                                    <span>↑</span>
                                @else
                                    <span>↓</span>
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tech Stack
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('date')">
                            Date
                            @if($sortField === 'date')
                                @if($sortDirection === 'asc')
                                    <span>↑</span>
                                @else
                                    <span>↓</span>
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $project->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $project->stack }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $project->date ? date('M d, Y', strtotime($project->date)) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleActive({{ $project->id }})" class="px-2 py-1 text-xs font-medium rounded-full {{ $project->active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                    {{ $project->active ? 'Active' : 'Hidden' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $project->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $project->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this project?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No projects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>

    @if($isOpen)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
                <div class="px-6 py-4 bg-gray-100 border-b">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $projectId ? 'Edit Project' : 'Create New Project' }}
                    </h3>
                </div>

                <form wire:submit.prevent="store">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                            <input type="text" id="name" wire:model="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" wire:model="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stack" class="block text-sm font-medium text-gray-700">Tech Stack</label>
                            <textarea id="stack" wire:model="stack" rows="2"
                                placeholder="Laravel, Vue.js, Tailwind CSS, etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('stack') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date (Leave blank for today's date)</label>
                            <input type="date" id="date" wire:model="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <span class="ml-2 text-sm text-gray-700">Show on portfolio</span>
                            </label>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-100 flex justify-end">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md mr-2 hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div><div>
    <div class="py-4 px-4 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Portfolio Projects</h2>
            <div class="flex space-x-2">
                <div>
                    <input wire:model.debounce.300ms="search" type="text" placeholder="Search projects..."
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                </div>
                <button wire:click="create" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Add Project
                </button>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">
                            Project Name
                            @if($sortField === 'name')
                                @if($sortDirection === 'asc')
                                    <span>↑</span>
                                @else
                                    <span>↓</span>
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tech Stack
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('date')">
                            Date
                            @if($sortField === 'date')
                                @if($sortDirection === 'asc')
                                    <span>↑</span>
                                @else
                                    <span>↓</span>
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $project->description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $project->stack }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $project->date ? date('M d, Y', strtotime($project->date)) : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $project->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $project->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this project?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                No projects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>

    @if($isOpen)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
                <div class="px-6 py-4 bg-gray-100 border-b">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $projectId ? 'Edit Project' : 'Create New Project' }}
                    </h3>
                </div>

                <form wire:submit.prevent="store">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                            <input type="text" id="name" wire:model="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" wire:model="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stack" class="block text-sm font-medium text-gray-700">Tech Stack</label>
                            <textarea id="stack" wire:model="stack" rows="2"
                                placeholder="Laravel, Vue.js, Tailwind CSS, etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('stack') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date (Leave blank for today's date)</label>
                            <input type="date" id="date" wire:model="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-100 flex justify-end">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md mr-2 hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
