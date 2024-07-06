<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('View Carpool Request') }}
        </h2>
    </x-slot>

    @php
        $carpoolDriver = $carpoolRequest->carpoolDriver;
    @endphp

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
                <!-- Back Button -->
                <x-button-link href="{{ route('carpool_requests.index') }}" text="Back to Carpool Requests List" arrowType="left"/>

                <div class="container grid px-6 mx-auto lg:w-3/5">
                    <div class="items-center p-4 my-6">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <!-- ID -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->id }}</span>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->description }}</span>
                                </div>
                            </div>
                            <!-- Departure Date -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="departure_date" class="block text-sm font-medium text-gray-700">Date</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->departure_date }}</span>
                                </div>
                            </div>
                            <!-- Departure Time -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="departure_time" class="block text-sm font-medium text-gray-700">Time</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->departure_time }}</span>
                                </div>
                            </div>
                            <!-- Departure Location -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="departure_location" class="block text-sm font-medium text-gray-700">Departure Location</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->departure_location }}</span>
                                </div>
                            </div>
                            <!-- Destination -->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolRequest->destination }}</span>
                                </div>
                            </div>
                            <!-- Driver Name-->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="driver_full_name" class="block text-sm font-medium text-gray-700">Driver Name</label>
                                <div class="flex justify-between">
                                    <span>{{ $carpoolDriver->full_name }}</span>
                                </div>
                            </div>
                            <!-- Driver Name-->
                            <div class="px-4 py-2 bg-white border-b sm:p-6">
                                <label for="driver_phone" class="block text-sm font-medium text-gray-700">Mobile Phone</label>
                                <div class="flex justify-start">
                                    <span>{{ $carpoolDriver->user->phone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
