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
                <input type="password" id="password" name="password" class="block w-full mt-1 rounded focus:border-fuchsia-600 focus:ring-fuchsia-600" required>
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center px-4 sm:px-6">
                <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-800 hover:bg-fuchsia-700 active:fuchsia-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-fuchsia disabled:opacity-25">
                    Unlock
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <!-- Want to log out? -->
            <div class="flex items-center justify-end px-4 py-3 sm:px-6">
                <label for="logout" class="block text-sm font-medium text-gray-700">Want to log out?</label>
                <x-button class="ms-4" x-on:click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

