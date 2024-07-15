<x-admin-app-layout>
    <x-slot name="title">
        Transport Requests
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">
        <div class="flex flex-row mb-6 space-x-8">
            <a href="{{ route('admin.transport_requests.create') }}" class="flex justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max items -center focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-calendar-plus"></i>
                    Add New Transport Request
                </div>
            </a>
            <!-- Generate Report -->
            <a href="{{ route('admin.transport_requests.report') }}" class="flex justify-between p-4 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 max-w-max items -center focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-file-pdf"></i>
                    Generate Monthly Report
                </div>
            </a>
        </div>

        <!-- Search bar -->
        <form action="{{ route('admin.transport_requests.search') }}" method="GET">
            <x-search-field />
        </form>

        <!-- Filter -->
        <form action="{{ route('admin.transport_requests.filter') }}" method="GET">
            <x-transport-requests-filter />
        </form>

        <x-tables.table-transport-requests-edit :transport-requests='$transportRequests'/>
    </div>
</x-admin-app-layout>

