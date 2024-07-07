<x-admin-app-layout>
    <x-slot name="title">
        Transport Schedule Details
    </x-slot>

    @php
        $schoolVehicle = $transportSchedule->schoolVehicle;
        if(empty($schoolVehicle))
            $schoolDriver = null;
        else
            $schoolDriver = $schoolVehicle->schoolDriver;
    @endphp

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.transport_schedules.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to Transport Schedules List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- Schedule ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="schedule_id" class="block text-sm font-medium text-gray-700">Schedule ID</label>
                    <div class="flex justify-between">
                        <span>{{ $transportSchedule->id }}</span>
                    </div>
                </div>
                <!-- Transport Request ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="transport_request_id" class="block text-sm font-medium text-gray-700">Transport Request ID</label>
                    <div class="flex justify-between">
                        <span>
                            @empty($transportSchedule->transport_request_id)
                                N/A
                            @else
                                {{ $transportSchedule->transport_request_id }}
                            @endempty
                        </span>
                    </div>
                </div>
                <!-- Schedule Title -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="flex justify-between">
                        <span>{{ $transportSchedule->title }}</span>
                    </div>
                </div>
                <!-- Schedule Description -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="flex justify-between">
                        <span>{{ $transportSchedule->description }}</span>
                    </div>
                </div>
                <!-- Schedule Date -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="schedule_date" class="block text-sm font-medium text-gray-700">Date</label>
                    <div class="flex justify-start">
                        <span>{{ $transportSchedule->schedule_date }}</span>
                    </div>
                </div>
                <!-- Schedule Time -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="schedule_time" class="block text-sm font-medium text-gray-700">Time</label>
                    <div class="flex justify-between">
                        <span>{{ $transportSchedule->schedule_time }}</span>
                    </div>
                </div>
                <!-- Starting Point -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="starting_point" class="block text-sm font-medium text-gray-700">Starting Point</label>
                    <div class="flex justify-between">
                        <span>{{ $transportSchedule->starting_point }}</span>
                    </div>
                </div>
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
            </div>
        </div>
    </div>


</x-admin-app-layout>
