<x-admin-app-layout>
    <x-slot name="title">
        Transport Schedules
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <a href="{{ route('admin.transport_schedules.create') }}"
                class="flex justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max items -center focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-calendar-plus"></i>
                    Add New Transport Schedule
                </div>
            </a>
        </div>

        <!-- Search bar -->
        <form action="{{ route('admin.transport_schedules.search') }}" method="GET">
            <x-search-field />
        </form>

        <!-- Filter -->
        <form action="{{ route('admin.transport_schedules.filter') }}" method="GET">
            <x-trip-status-filter />
        </form>

        <!-- Table -->
        <x-tables.table-transport-schedules-edit :transport-schedules='$transportSchedules' />
</x-admin-app-layout>
