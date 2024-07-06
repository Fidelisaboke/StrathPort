<x-admin-app-layout>
    <x-slot name="title">
        School Driver Details
    </x-slot>

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.school_drivers.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to School Drivers List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="id" class="block text-sm font-medium text-gray-700">Driver ID</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolDriver->id }}</span>
                    </div>
                </div>
                <!-- First Name-->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolDriver->first_name }}</span>
                    </div>
                </div>
                <!-- Last Name -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolDriver->last_name }}</span>
                    </div>
                </div>
                <!-- Driver Phone Number -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolDriver->phone }}</span>
                    </div>
                </div>
                <!-- Availability Status -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="availability_status" class="block text-sm font-medium text-gray-700">Availability Status</label>
                    <div class="flex justify-between">
                        <span>{{ $schoolDriver->availability_status }}</span>
                    </div>
                </div>

</x-admin-app-layout>
