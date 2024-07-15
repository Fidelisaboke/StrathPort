<x-admin-app-layout>
    <x-slot name="title">
        School Drivers
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <a href="{{ route('admin.school_drivers.create') }}"
                class="flex justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max items -center focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-user-plus"></i>
                    Add New School Driver
                </div>
            </a>
        </div>

        <!-- Search bar -->
        <form action="{{ route('admin.school_drivers.search') }}" method="GET">
            <x-search-field />
        </form>

        <!-- Avaiilability filter -->
        <form action="{{ route('admin.school_drivers.filter') }}" method="GET">
            <x-availability-filter />
        </form>

            <x-tables.table-school-drivers-edit :school-drivers='$schoolDrivers' />
    </div>
</x-admin-app-layout>
