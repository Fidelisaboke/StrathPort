<!-- Show user details -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('View Carpool Schedule') }}
        </h2>
    </x-slot>

    <x-status-message />

    @php
        $carpoolRequest = $carpoolingDetail->carpoolRequest;
        $carpoolDriver = $carpoolRequest->carpoolDriver;
        $carpoolVehicle = $carpoolDriver->carpoolVehicle;
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
                        <!-- Driver Name-->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="driver_full_name" class="block text-sm font-medium text-gray-700">Driver Name</label>
                            <div class="flex justify-between">
                                <span>{{ $carpoolDriver->full_name }}</span>
                            </div>
                        </div>
                        <!-- Driver Phone-->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="driver_phone" class="block text-sm font-medium text-gray-700">Mobile Phone</label>
                            <div class="flex justify-start">
                                <span>{{ $carpoolDriver->user->phone }}</span>
                            </div>
                        </div>
                        <!-- Vehicle Registration Number -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="registration_number" class="block text-sm font-medium text-gray-700">Vehicle Registration Number</label>
                            <div class="flex justify-between">
                                @empty($carpoolVehicle)
                                    <span class="text-red-600">No vehicle assigned</span>
                                @else
                                    <span>{{ $carpoolVehicle->number_plate }}</span>
                                @endempty
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="flex justify-between">
                                <span>{{ $carpoolingDetail->status }}</span>
                                @if($carpoolingDetail->carpoolRequest && $carpoolingDetail->status == 'In Progress')
                                    <div class="flex items-center">
                                        <form action="{{ route('driver.carpooling_details.completeTrip', $carpoolingDetail->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Mark as Completed</button>
                                        </form>
                                        <form action="{{ route('driver.carpooling_details.cancelTrip', $carpoolingDetail->id) }}" method="POST" x-data>
                                            @csrf
                                            @method('PUT')
                                            <button @click.prevent="$dispatch('cancelTrip', { redirectUrl: 'carpooling_details', id: {{ $carpoolingDetail->id }}, modelClass: 'App\\Models\\CarpoolingDetails' })" type="submit" class="px-4 py-2 ml-4 text-white bg-red-500 rounded hover:bg-red-600">Cancel Trip</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
