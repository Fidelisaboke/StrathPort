<x-admin-app-layout>
    <x-slot name="title">
        Edit Transport Schedule
    </x-slot>

    @php
        // Get all available school vehicles
        $schoolVehicles = App\Models\SchoolVehicle::where('availability_status', 'Available')->get();
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
            <form method="post" action="{{ route('admin.transport_schedules.update', $transportSchedule->id) }}">
                @csrf
                @method('PUT')
                <div class="overflow-hidden shadow sm:rounded-md">
                    <!-- Title -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('title', $transportSchedule->title) }}" />
                        @error('title')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Description -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="description" id="description" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('description', $transportSchedule->description) }}" />
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Date -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="schedule_date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="schedule_date" id="schedule_date"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('schedule_date', $transportSchedule->schedule_date) }}" />
                        @error('schedule_date')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Time -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="schedule_time" class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" name="schedule_time" id="schedule_time"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('schedule_time', $transportSchedule->schedule_time) }}" />
                        @error('schedule_time')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Starting Point -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="starting_point" class="block text-sm font-medium text-gray-700">Starting
                            Point</label>
                        <input type="text" name="starting_point" id="starting_point" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('starting_point', $transportSchedule->starting_point) }}" />
                        @error('starting_point')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Destination -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                        <input type="text" name="destination" id="destination" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('destination', $transportSchedule->destination) }}" />
                        @error('destination')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select School Vehicle -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="school_vehicle_id" class="block text-sm font-medium text-gray-700">Select School
                            Vehicle</label>
                        <select name="school_vehicle_id" id="school_vehicle_id"
                            class="block w-full mt-1 rounded-md shadow-sm form-select">
                            @foreach ($schoolVehicles as $schoolVehicle)
                                <option value="{{ $schoolVehicle->id }}"
                                    {{ $schoolVehicle->id == $transportSchedule->school_vehicle_id ? 'selected' : '' }}>
                                    {{ $schoolVehicle->number_plate }}</option>
                            @endforeach
                        </select>
                        @error('school_vehicle_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                            Update
                        </button>
                    </div>

</x-admin-app-layout>
