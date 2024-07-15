<x-admin-app-layout>
    <x-slot name="title">
        Edit Carpool Vehicle
    </x-slot>

    @php
        $carpoolVehicles = \App\Models\CarpoolDriver::all();
    @endphp

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.carpool_vehicles.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to Carpool Vehicles List
        </a>
    </div>

    <div class="container grid px-6 mx-auto">
        <div class="flex flex-col items-center my-6 md:flex-row">
            <div class="md:w-3/5 md:mr-6">
                <form method="post" action="{{ route('admin.carpool_vehicles.update', $carpoolVehicle->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- Make -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                            <input type="text" name="make" id="make"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('make', $carpoolVehicle->make) }}" />
                            @error('make')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Model -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                            <input type="text" name="model" id="model"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('model', $carpoolVehicle->model) }}" />
                            @error('model')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Year -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                            <input type="text" name="year" id="year"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('year', $carpoolVehicle->year) }}" />
                            @error('year')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Number Plate -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="number_plate" class="block text-sm font-medium text-gray-700">Number
                                Plate</label>
                            <input type="text" name="number_plate" id="number_plate"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('number_plate', $carpoolVehicle->number_plate) }}" />
                            @error('number_plate')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Capacity -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input type="number" name="capacity" id="capacity"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('capacity', $carpoolVehicle->capacity) }}" />
                            @error('capacity')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Vehicle Photo -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="vehicle_photo" class="block text-sm font-medium text-gray-700">Vehicle
                                Photo</label>
                            <div class="text-sm text-gray-600">
                                <p>Upload a photo of the vehicle. For the best view, the width should be the
                                    same as the height, (e.g. 256 x 256)</p>
                            </div>
                            <input type="file" name="vehicle_photo" id="vehicle_photo"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" />
                            @error('vehicle_photo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Remove existing photo -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <x-checkbox name="remove_photo" id="remove_photo" />
                            <label for="remove_photo" class="text-sm font-medium text-gray-700">Remove Existing
                                Photo</label>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Vehicle Photo Display -->
            <div class="flex items-center justify-center mt-6 md:mt-0 md:w-2/5">
                <div class="w-full max-w-md">
                    <div class="bg-white shadow sm:rounded-md">
                        <div class="px-4 py-5 sm:p-6">
                            <label for="vehicle_photo" class="block text-sm font-medium text-gray-700">Vehicle
                                Photo</label>
                            @empty($carpoolVehicle->vehicle_photo_url)
                                <img id='vehicle_photo_preview' src="{{ asset('images/car_placeholder.png') }}"
                                    alt="Vehicle Photo" class="w-full h-auto mt-2">
                            @else
                                <img id='vehicle_photo_preview' src="{{ $carpoolVehicle->vehicle_photo_url }}"
                                    alt="Vehicle Photo" class="w-full h-auto mt-2">
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-admin-app-layout>
<script>
    document.getElementById('vehicle_photo').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('vehicle_photo_preview').src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
