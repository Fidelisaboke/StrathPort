<x-admin-app-layout>
    <x-slot name="title">
        Carpool Drivers
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">

        {{-- <div class="grid gap-6 mb-8 md:grid-cols-2">
            <a href="{{ route('admin.carpool_drivers.create') }}" class="flex items-center justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-user-plus"></i>
                    Add New Carpool Driver
                </div>
            </a>
        </div> --}}

        <!-- Search bar -->
        <form action="{{ route('admin.carpool_drivers.search') }}" method="GET">
            <x-search-field />
        </form>

        <!-- availability filter -->
        <form action="{{route('admin.carpool_drivers.filter')}}" method="GET">
            <x-availability-filter />
        </form>

        <x-tables.table-carpool-drivers-edit :carpool-drivers='$carpoolDrivers'/>
    </div>
</x-admin-app-layout>

