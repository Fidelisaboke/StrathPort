<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="md:gap-24 md:grid-cols-2 md:grid">
                    <div class="p-4 mb-8 bg-white shadow-xl md:flex-col md:flex sm:rounded-lg md:mb-0">
                        <h2 class="text-lg font-semibold text-gray-800">Upcoming Trips</h2>
                        <x-upcoming-trips-table />
                        <!-- View full schedule -->
                        <a href="{{ route('transport_schedules.index') }}" class="self-center w-3/5 p-2 mt-4 text-center text-white rounded bg-fuchsia-700 hover:bg-fuchsia-800">View Full Schedule</a>
                    </div>
                    <div class="items-center p-4 bg-white shadow-xl md:flex-col md:flex sm:rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-800">Transport Request History</h2>
                        <x-transport-request-history />
                        <!-- View transport requests -->
                        <a href="{{ route('transport_requests.index') }}" class="self-center w-3/5 p-2 mt-4 text-center text-white rounded bg-fuchsia-700 hover:bg-fuchsia-800">View Transport Requests</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
