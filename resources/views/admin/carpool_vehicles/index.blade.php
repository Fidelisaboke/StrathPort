<x-admin-app-layout>
    <x-slot name="title">
        Carpool Vehicles
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <a href="{{ route('admin.carpool_vehicles.create') }}" class="flex items-center justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-plus"></i>
                    Add New Carpool Vehicle
                </div>
            </a>
        </div>

        <!-- Search bar -->
        <form action="{{ route('admin.carpool_vehicles.search') }}" method="GET">
            <x-search-field />
        </form>

        <x-tables.table-carpool-vehicles-edit :carpool-vehicles='$carpoolVehicles'/>
    </div>
</x-admin-app-layout>
