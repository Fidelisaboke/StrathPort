<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Transport Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-4 md:gap-8 md:grid-cols-2 md:grid md:space-y-0">
                <x-transport-schedules-view />
            </div>
        </div>
    </div>
</x-app-layout>
