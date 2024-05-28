<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        @vite(['resources/js/app.js'])
        <h1><b>Website Locked</b></h1>
        <hr>
        <form method="post" action="{{ route('unlock') }}">
            @csrf
            <div class="px-4 py-5 bg-white sm:p-6">
                <label for="password">Please enter your password to unlock:</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full rounded" required>
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                    Unlock
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

