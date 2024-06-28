<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Transport Requests') }}
        </h2>
    </x-slot>

    <!-- Status messages -->
    @if (session('success'))
        <div class="p-4 mb-4 text-center text-white bg-green-400">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="p-4 mb-4 text-center text-white bg-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{route('transport_requests.create')}}" class="inline-block px-4 py-2 mb-4 font-bold text-white rounded bg-fuchsia-600 hover:bg-fuchsia-700">Create Transport Request</a>
            <!-- Search bar -->
            <form action="{{ route('transport_requests.search')}}" method="GET">
                <x-search-field />
            </form>
            <!-- Filter by transport request status -->
            <form action="{{ route('transport_requests.filter')}}" method="GET">
                <x-transport-requests-filter />
            </form>
            <x-transport-requests-view :transport-requests='$transportRequests'/>
        </div>
    </div>
</x-app-layout>
