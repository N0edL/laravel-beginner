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
                    {!! nl2br($this->getMarkedDownText()) !!}
                </p>
            </div>
        </div>
    </div>

    @if($isOpen)
        <div class="fixed z-50 inset-0 bg-gray-500 bg-opacity-75 dark:bg-neutral-800/75 flex items-center justify-center" wire:click.self="closeModal">
            <div class="bg-white dark:bg-neutral-800 rounded-lg overflow-hidden shadow-xl max-w-5xl w-full">
                <div class="px-6 py-4 bg-gray-100 dark:bg-neutral-700 border-b dark:border-neutral-600">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-neutral-100">
                        Edit "About Me Text"
                    </h3>
                </div>

                <form wire:submit.prevent="store">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                    About Me Text
                                </label>
                                <button type="button" wire:click="togglePreview"
                                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    {{ $previewMode ? 'Edit' : 'Preview' }}
                                </button>
                            </div>

                            @if($previewMode)
                                <div class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 bg-gray-50 p-3 h-full">
                                    <div class="text-gray-700 dark:text-neutral-300">
                                        {!! nl2br($this->getPreviewText()) !!}
                                    </div>
                                </div>
                            @else
                                <textarea id="description" wire:model="description" rows="5"
                                    placeholder="Enter your about me text here..."
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 min-h-[260px] resize-y overflow-auto"></textarea>
                            @endif

                            @error('description')
                                <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-md">
                            <p class="text-sm text-blue-700 dark:text-blue-300 font-medium mb-2">Custom Markdown Usage:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-blue-600 dark:text-blue-400">
                                <div>
                                    <p class="font-medium mb-1">Custom Tags:</p>
                                    <ul class="space-y-1">
                                        <li><code>&lt;age:name&gt;</code> - Shows user's age</li>
                                        <li><code>&lt;fullname:name&gt;</code> - Shows user's full name</li>
                                        <li><code>&lt;tap&gt;</code> - Shows count of total active projects</li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="font-medium mb-1">Text Formatting:</p>
                                    <ul class="space-y-1">
                                        <li><code>**bold**</code> or <code>__bold__</code> - <strong>Bold text</strong></li>
                                        <li><code>*italic*</code> or <code>_italic_</code> - <em>Italic text</em></li>
                                        <li><code>++underline++</code> - <u>Underlined text</u></li>
                                        <li><code>`code`</code> - <code>Inline code</code></li>
                                        <li><code>/n</code> - Line break</li>
                                        <li><code>&lt;br&gt;</code> - New paragraph</li>
                                    </ul>
                                </div>
                            </div>
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
