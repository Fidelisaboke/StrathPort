<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Carpool Requests') }}
        </h2>
    </x-slot>

    <x-status-message/>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{route('carpool_requests.create')}}" class="flex flex-row justify-center px-4 py-2 mx-8 mb-4 font-bold text-white rounded md:mx-0 md:inline-block bg-fuchsia-600 hover:bg-fuchsia-700">Make a Carpooling Request</a>
            <!-- Search bar -->
            <form action="{{ route('carpool_requests.search')}}" method="GET">
                <x-search-field />
            </form>
            <!-- Filter by carpool request status -->
            <form action="{{ route('carpool_requests.filter')}}" method="GET">
                <x-transport-requests-filter />
            </form>
            <div class="flex flex-row justify-center mb-4">
                {{$carpoolRequests->links()}}
            </div>
            <x-carpool-requests-view :carpool-requests='$carpoolRequests'/>
        </div>
    </div>
</x-app-layout>
