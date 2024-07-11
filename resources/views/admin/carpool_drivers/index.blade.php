<x-admin-app-layout>
    <x-slot name="title">
        Carpool Drivers
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">

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

