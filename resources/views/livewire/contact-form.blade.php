<main class="max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
    @if (session()->has('success'))
    <div class="bg-green-200 text-green-800 px-4 py-2 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="bg-red-800 text-white px-4 py-2 rounded-lg mb-4">
        {{ session('error') }}
    </div>
    @endif
    <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
        <h1 class="mb-1 font-medium">Contact Us</h1>
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Feel free to reach out to us by filling out the form below.</p>
        <form wire:submit.prevent="send" class="flex flex-col gap-4">
            @csrf

            <!-- Honeypot field - hidden from users, but bots might fill it -->
            <div style="display:none" aria-hidden="true">
                <label for="honeypot">Leave this field empty:</label>
                <input type="text" id="honeypot" wire:model="honeypot" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-[#EDEDEC]">Name:</label>
                <input type="text" id="name" wire:model="name" autocomplete="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-[#EDEDEC]">
                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-[#EDEDEC]">Email:</label>
                <input type="email" id="email" wire:model="email" autocomplete="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-[#EDEDEC]">
                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-[#EDEDEC]">Message:</label>
                <textarea id="message" wire:model="message" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-[#EDEDEC]"></textarea>
                @error('message') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="relative">
                <button wire:loading.remove wire:target='send' type="submit" class="relative w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 ease-in-out">
                    <span class="font-semibold">Submit</span>
                </button>
                <div wire:loading wire:target='send' class="relative w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 ease-in-out">
                    <div class="flex items-center justify-center">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span class="ml-2 text-white font-medium">Sending...</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
