<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Transport Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            <!-- Search bar -->
            <form action="{{ route('transport_schedules.search')}}" method="GET">
                <x-search-field />
            </form>

            <!-- Display transport schedules from search -->
            @if ($transportSchedules->count() > 0)
                <div class="mt-8">
                    <div class="flex flex-row justify-center mb-4">
                        {{$transportSchedules->links()}}
                    </div>
                    <x-transport-schedules-view :transport-schedules='$transportSchedules' />
                </div>
            @else
                <div class="mt-8">
                    <p class="text-lg text-center text-gray-700">No transport schedules found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
