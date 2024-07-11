<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('View Transport Schedule') }}
        </h2>
    </x-slot>

    @php
        $schoolVehicle = $transportSchedule->schoolVehicle;
        if(empty($schoolVehicle))
            $schoolDriver = null;
        else
            $schoolDriver = $schoolVehicle->schoolDriver;
    @endphp

    <div class="py-4">
        <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <x-button-link href="{{ route('transport_schedules.index') }}" text="Back to Transport Schedules List" arrowType="left"/>


            <div class="container grid px-6 mx-auto md:w-3/5">
                <div class="items-center p-4 my-6">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- ID -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->id }}</span>
                            </div>
                        </div>
                        <!-- Title -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->title }}</span>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->description }}</span>
                            </div>
                        </div>
                        <!-- Date -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="event_date" class="block text-sm font-medium text-gray-700">Date</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->schedule_date }}</span>
                            </div>
                        </div>
                        <!-- Time -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="event_time" class="block text-sm font-medium text-gray-700">Time</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->schedule_time }}</span>
                            </div>
                        </div>
                        <!-- Starting Point -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="starting_location" class="block text-sm font-medium text-gray-700">Starting
                                Point</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->starting_point }}</span>
                            </div>
                        </div>
                        <!-- Destination -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->destination }}</span>
                            </div>
                        </div>
                        <!-- Vehicle Registration Number -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="registration_number" class="block text-sm font-medium text-gray-700">Vehicle Registration Number</label>
                            <div class="flex justify-between">
                                @empty($schoolVehicle)
                                    <span class="text-red-600">No vehicle assigned</span>
                                @else
                                    <span>{{ $schoolVehicle->number_plate }}</span>
                                @endempty
                            </div>
                        </div>
                        <!-- School Driver -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="school_driver" class="block text-sm font-medium text-gray-700">School Driver</label>
                            <div class="flex justify-between">
                                @empty($schoolDriver)
                                    <span class="text-red-600">No driver assigned</span>
                                @else
                                    <span>{{ $schoolDriver->full_name }}</span>
                                @endempty
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->status }}</span>
                                @if($transportSchedule->transportRequest && $transportSchedule->status == 'In Progress')
                                    <div class="flex items-center">
                                        <form action="{{ route('transport_schedules.completeTrip', $transportSchedule->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Mark as Completed</button>
                                        </form>
                                        <form action="{{ route('transport_schedules.cancelTrip', $transportSchedule->id) }}" method="POST" x-data>
                                            @csrf
                                            @method('PUT')
                                            <button @click.prevent="$dispatch('cancelTrip', { redirectUrl: 'transport_schedules', id: {{ $transportSchedule->id }}, modelClass: 'App\\Models\\TransportSchedule' })" type="submit" class="px-4 py-2 ml-4 text-white bg-red-500 rounded hover:bg-red-600">Cancel Trip</button>
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
@livewire('trip-cancel-confirmation-modal')
