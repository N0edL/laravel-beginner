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
    <div class="">
        <form wire:submit.prevent="send" class="flex flex-col gap-4">
            @csrf

            <!-- Honeypot field - hidden from users, but bots might fill it -->
            <div style="display:none" aria-hidden="true">
                <label for="honeypot">Leave this field empty:</label>
                <input type="text" id="honeypot" wire:model="honeypot" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" id="name" wire:model="name" placeholder="Your Name" autocomplete="name" class="mt-1 text-lg block w-full rounded-md shadow-sm bg-gray-dark/50 border-gray/50 focus:ring-blue focus:border-blue ">
                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                <label for="email" class="block text-sm font-medium mt-4">Email</label>
                <input type="email" id="email" wire:model="email" placeholder="email@example.com" autocomplete="email" class="mt-1 text-lg block w-full rounded-md shadow-sm bg-gray-dark/50 border-gray/50 focus:ring-blue focus:border-blue ">
                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                <label for="message" class="block text-sm font-medium mt-4">Message</label>
                <textarea id="message" wire:model="message" placeholder="Write your message here..." class="mt-1 min-h-24 text-lg block w-full rounded-md shadow-sm bg-gray-dark/50 border-gray/50 focus:ring-blue focus:border-blue "></textarea>
                @error('message') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="relative">
                <button wire:loading.remove wire:target='send' type="submit" class="flex items-center justify-center gap-3 relative w-full bg-blue text-white py-3 px-4 rounded-full hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 ease-in-out">
                    <span class="font-semibold">Send Message</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send "><path d="m22 2-7 20-4-9-9-4Z"></path><path d="M22 2 11 13"></path></svg>
                </button>
                <div wire:loading wire:target='send' class="flex items-center justify-center gap-3 relative w-full bg-blue text-white py-3 px-4 rounded-full hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 ease-in-out">
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
