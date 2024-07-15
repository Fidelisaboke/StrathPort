<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Carpooling Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            <!-- Search bar -->
            <form action="{{ route('carpooling_details.search')}}" method="GET">
                <x-search-field />
            </form>

            <!-- trip status filter -->
            <form action="{{ route('carpooling_details.filter')}}" method="GET">
                <x-trip-status-filter />
            </form>

            <!-- Display carpooling details from search -->
            @if ($carpoolingDetails->count() > 0)
                <div class="mt-8">
                    <div class="flex flex-row justify-center mb-4">
                        {{$carpoolingDetails->links()}}
                    </div>
                    <x-carpooling-details-view :carpooling-details='$carpoolingDetails' />
                </div>
            @else
                <div class="mt-8">
                    <p class="text-lg text-center text-gray-700">No carpooling details found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
