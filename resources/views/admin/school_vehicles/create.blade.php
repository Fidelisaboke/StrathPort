<x-admin-app-layout>
    <x-slot name="title">
        Add School Vehicle
    </x-slot>

    @php
        $schoolDrivers = \App\Models\SchoolDriver::all();
    @endphp

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.school_vehicles.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to School Vehicles List
        </a>
    </div>

    <div class="container grid px-6 mx-auto md:w-3/5">
        <div class="items-center p-4 my-6">
            <form method="post" action="{{ route('admin.school_vehicles.store') }}">
                @csrf
                <div class="overflow-hidden shadow sm:rounded-md">
                    <!-- Make -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                        <input type="text" name="make" id="make" class="block w-full mt-1 rounded-md shadow-sm form-input"
                               value="{{ old('make', '') }}" />
                        @error('make')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Model -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" class="block w-full mt-1 rounded-md shadow-sm form-input"
                               value="{{ old('model', '') }}" />
                        @error('model')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Year -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="text" name="year" id="year" class="block w-full mt-1 rounded-md shadow-sm form-input"
                               value="{{ old('year', '') }}" />
                        @error('year')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Number Plate -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="number_plate" class="block text-sm font-medium text-gray-700">Number Plate</label>
                        <input type="text" name="number_plate" id="number_plate" class="block w-full mt-1 rounded-md shadow-sm form-input"
                               value="{{ old('number_plate', '') }}" />
                        @error('number_plate')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Capacity -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="block w-full mt-1 rounded-md shadow-sm form-input"
                               value="{{ old('capacity', '') }}" />
                        @error('capacity')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Availability Status -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="availability_status" class="block text-sm font-medium text-gray-700">Availability Status</label>
                        <select name="availability_status" id="availability_status" class="block w-full mt-1 rounded-md shadow-sm form-select">
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                        @error('availability_status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Select School Driver -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="school_driver_id" class="block text-sm font-medium text-gray-700">Select School Driver</label>
                        <select name="school_driver_id" id="school_driver_id" class="block w-full mt-1 rounded-md shadow-sm form-select">
                            @foreach($schoolDrivers as $schoolDriver)
                                <option value="{{ $schoolDriver->id }}">{{ $schoolDriver->full_name }}</option>
                            @endforeach
                        </select>
                        @error('school_driver_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-app-layout>
