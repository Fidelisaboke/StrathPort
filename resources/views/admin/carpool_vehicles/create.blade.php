<x-admin-app-layout>
    <x-slot name="title">
        Add Carpool Vehicle
    </x-slot>

    @php
    // Get all carpool drivers without a vehicle

    $caproolDrivers = Illuminate\Support\Facades\DB::table('carpool_drivers')
        ->leftJoin('carpool_vehicles', 'carpool_drivers.id', '=', 'carpool_vehicles.driver_id')
        ->whereNull('carpool_vehicles.driver_id')
        ->select('carpool_drivers.*')
        ->get();

    @endphp


    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.carpool_vehicles.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to Carpool Vehicles List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <form method="post" action="{{ route('admin.carpool_vehicles.store') }}">
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
                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                            Submit
                        </button>
                    </div>
                    <!-- Select Carpool Driver -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="carpool_driver_id" class="block text-sm font-medium text-gray-700">Select Carpool Driver</label>
                        <select name="carpool_driver_id" id="carpool_driver_id" class="block w-full mt-1 rounded-md shadow-sm form-select">
                            @foreach($carpoolDrivers as $carpoolDriver)
                                <option value="{{ $carpoolDriver->id }}">{{ $carpoolDriver->full_name }}</option>
                            @endforeach
                        </select>
                        @error('carpool_driver_id')
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
