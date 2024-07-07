<!-- Show user details -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('View Carpool Schedule') }}
        </h2>
    </x-slot>

    @php
        $carpoolRequest = $carpoolingDetail->carpoolRequest;
        $carpoolDriver = $carpoolRequest->carpoolDriver;
    @endphp

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="px-4 py-2 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
                <a href="{{ route('driver.carpooling_details.index') }}" class="flex items-center justify-center text-white">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Back to Carpool Schedule List
                </a>
            </div>

            <div class="container grid px-6 mx-auto md:w-3/5">
                <div class="items-center p-4 my-6">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- ID -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                            <div class="flex justify-between">
                                <span>{{ $carpoolingDetail->id }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
