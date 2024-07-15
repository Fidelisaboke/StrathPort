<x-admin-app-layout>
    <x-slot name="title">
        Carpool Vehicle Details
    </x-slot>

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.carpool_vehicles.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to Carpool Vehicles List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="id" class="block text-sm font-medium text-gray-700">Vehicle ID</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->id }}</span>
                    </div>
                </div>
                <!-- Driver -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="driver" class="block text-sm font-medium text-gray-700">Carpool Driver</label>
                    <div class="flex justify-between">
                        @empty($carpoolVehicle->carpoolDriver)
                            <span class="text-red-600">No driver assigned</span>
                        @else
                            <span>{{ $carpoolVehicle->carpoolDriver->full_name }}</span>
                        @endempty
                    </div>
                </div>
                <!-- Make -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->make }}</span>
                    </div>
                </div>
                <!-- Model -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->model }}</span>
                    </div>
                </div>
                <!-- Year -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->year }}</span>
                    </div>
                </div>
                <!-- Number Plate -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="number_plate" class="block text-sm font-medium text-gray-700">Number Plate</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->number_plate }}</span>
                    </div>
                </div>
                <!-- Capacity -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                    <div class="flex justify-between">
                        <span>{{ $carpoolVehicle->capacity }}</span>
                    </div>
                </div>
                <!-- Vehicle Photo Preview -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="vehicle_photo_preview" class="block text-sm font-medium text-gray-700">Vehicle Photo
                        Preview</label>
                    <div class="flex justify-between">
                        @empty($carpoolVehicle->vehicle_photo_url)
                            <span class="text-red-600">No photo uploaded</span>
                        @else
                            <img src="{{ $carpoolVehicle->vehicle_photo_url }}" alt="Vehicle Photo Preview"
                                class="w-1/2 h-auto mx-auto mt-4 rounded shadow-lg" />
                        @endempty
                    </div>
                </div>
                <!-- Vehicle Photo URL -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="vehicle_photo_path" class="block text-sm font-medium text-gray-700">Vehicle
                        Photo URL</label>
                    <div class="flex justify-between">
                        @empty($carpoolVehicle->vehicle_photo_url)
                            <span class="text-red-600">No photo uploaded</span>
                        @else
                            <span>{{ $carpoolVehicle->vehicle_photo_url }}</span>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
</x-admin-app-layout>
