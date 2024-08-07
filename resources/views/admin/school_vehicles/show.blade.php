<x-admin-app-layout>
    <x-slot name="title">
        School Vehicle Details
    </x-slot>

    @php
        $schoolDriver = $schoolVehicle->schoolDriver
    @endphp

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.school_vehicles.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to School Vehicles List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="id" class="block text-sm font-medium text-gray-700">Vehicle ID</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->id }}</span>
                    </div>
                </div>
                <!-- Driver -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="driver" class="block text-sm font-medium text-gray-700">School Driver</label>
                    <div class="flex justify-between">
                        @empty($schoolDriver)
                            <span class="text-red-600">No driver assigned</span>
                        @else
                            <span>{{ $schoolDriver->full_name }}</span>
                        @endempty
                    </div>
                </div>
                <!-- Make -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->make }}</span>
                    </div>
                </div>
                <!-- Model -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->model }}</span>
                    </div>
                </div>
                <!-- Year -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->year }}</span>
                    </div>
                </div>
                <!-- Number Plate -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="number_plate" class="block text-sm font-medium text-gray-700">Number Plate</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->number_plate }}</span>
                    </div>
                </div>
                <!-- Capacity -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->capacity }}</span>
                    </div>
                </div>
                <!-- Availability Status -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="availability_status" class="block text-sm font-medium text-gray-700">Availability Status</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolVehicle->availability_status }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
