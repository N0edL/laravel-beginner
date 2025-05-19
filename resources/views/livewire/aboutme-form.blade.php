<div>
    <div class="py-4 px-4 bg-white dark:bg-neutral-800 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100">About Me Text</h2>
            <div class="flex space-x-2">
                <button wire:click="edit" class="px-4 py-2 bg-gradient-to-r from-blue/80 to-sky-600 text-white rounded-md hover:bg-blue-700">
                    Edit
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="bg-white dark:bg-neutral-700 shadow-md rounded-lg">
                <p class="p-4 text-gray-700 dark:text-neutral-300">
                    {{ $text}}
                </p>
            </div>
        </div>
    </div>

    @if($isOpen)
        <div class="fixed z-50 inset-0 bg-gray-500 bg-opacity-75 dark:bg-neutral-800/75 flex items-center justify-center" wire:click.self="closeModal">
            <div class="bg-white dark:bg-neutral-800 rounded-lg overflow-hidden shadow-xl max-w-lg w-full">
            <div class="px-6 py-4 bg-gray-100 dark:bg-neutral-700 border-b dark:border-neutral-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-neutral-100">
                    Edit "About Me Text"
                </h3>
            </div>

            <form wire:submit.prevent="store">
                @csrf
                <div class="px-6 py-4">

                    <div class="mb-4">
                        <textarea id="description" wire:model="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                        @error('description')
                        <span class="text-red-500 dark:text-red-400 text-xs"></span>
                        @enderror
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
