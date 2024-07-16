<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Carpool Request
        </h2>
    </x-slot>

    <div>
        <!-- Back Button -->
        <div class="max-w-4xl px-6 pt-6 mx-auto">
            <x-button-link href="{{ route('carpool_requests.index') }}" text="Back to Carpool Requests List"
                arrowType="left" />
        </div>
        <div class="w-3/5 max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('carpool_requests.update', $carpoolRequest->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- Title -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('title', $carpoolRequest->title) }}" />
                            @error('title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description" id="description" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('description', $carpoolRequest->description) }}" />
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Select Driver Dropdown -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="carpool_driver_id" class="block text-sm font-medium text-gray-700">Select
                                Driver</label>
                            <select id="carpool_driver_id" name="carpool_driver_id"
                                class="block w-full mt-1 rounded-md shadow-sm form-input">
                                @foreach ($carpoolDrivers as $carpoolDriver)
                                    <option value="{{ $carpoolDriver->id }}"
                                        @if (old('carpool_driver_id', $carpoolDriver->id) == $carpoolDriver->id) selected @endif>
                                        {{ $carpoolDriver->full_name }} - Vehicle
                                        Capacity: {{ $carpoolDriver->carpoolVehicle->capacity }}</option>
                                @endforeach
                            </select>
                            @error('carpool_driver_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Date -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="departure_date" class="block text-sm font-medium text-gray-700">Departure
                                Date</label>
                            <input type="date" name="departure_date" id="departure_date" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('departure_date', $carpoolRequest->departure_date) }}" />
                            @error('departure_date')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Departure Time -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure
                                Time</label>
                            <input type="time" name="departure_time" id="departure_time" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('departure_time', $carpoolRequest->departure_time) }}" />
                            @error('departure_time')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Location -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="departure_location" class="block text-sm font-medium text-gray-700">Departure
                                Location</label>
                            <input type="text" name="departure_location" id="departure_location" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('departure_location', $carpoolRequest->departure_location) }}" />
                            @error('departure_location')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Destination -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                            <input type="text" name="destination" id="destination" type="text"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('destination', $carpoolRequest->destination) }}" />
                            @error('destination')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- No of People -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="no_of_people" class="block text-sm font-medium text-gray-700">Number of People
                                Expected</label>
                            <input type="number" min="1" max="1000" name="no_of_people" id="no_of_people"
                                type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('no_of_people', $carpoolRequest->no_of_people) }}" />
                            @error('no_of_people')
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
    </div>
</x-app-layout>
