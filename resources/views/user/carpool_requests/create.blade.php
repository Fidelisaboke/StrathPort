<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Make a Carpooling Request
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">

                @if($carpoolDrivers->count() < 1)
                    <p class="text-lg text-center text-gray-800">
                        No carpool drivers are available at the moment. Please try again later.
                    </p>
                @else
                    <form method="post" action="{{ route('carpool_requests.store') }}">
                        @csrf
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <!-- Title -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" id="title" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('title', '') }}" />
                                @error('title')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Description -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <input type="text" name="description" id="description" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('description', '') }}" />
                                @error('description')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Select Driver Dropdown -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="carpool_driver_id" class="block text-sm font-medium text-gray-700">Select Driver</label>
                                <select id="carpool_driver_id" name="carpool_driver_id" class="block w-full mt-1 rounded-md shadow-sm form-input">
                                    @foreach ($carpoolDrivers as $carpoolDriver)
                                        <option value="{{ $carpoolDriver->id }}">{{ $carpoolDriver->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Date -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="departure_date" class="block text-sm font-medium text-gray-700">Departure Date</label>
                                <input type="date" name="departure_date" id="departure_date" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('departure_date', '') }}" />
                                @error('departure_date')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                                <input type="time" name="departure_time" id="departure_time" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('departure_time', '') }}" />
                                @error('departure_time')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Location -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="departure_location" class="block text-sm font-medium text-gray-700">Departure Location</label>
                                <input type="text" name="departure_location" id="departure_location" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('departure_location', '') }}" />
                                @error('departure_location')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Destination -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                                <input type="text" name="destination" id="destination" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('destination', '') }}" />
                                @error('destination')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- No of People -->
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <label for="no_of_people" class="block text-sm font-medium text-gray-700">Number of People Expected</label>
                                <input type="number" min="1" max="1000" name="no_of_people" id="no_of_people" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('no_of_people', '') }}" />
                                @error('no_of_people')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
