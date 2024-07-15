<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add Your Vehicle Details
        </h2>
    </x-slot>

    <div>
        <!-- Back Button -->
        <div class="max-w-4xl px-6 pt-6 mx-auto">
            <x-button-link href="{{ route('driver.carpool_vehicles.index') }}" text="Back to Vehicle Information"
                arrowType="left" />
        </div>

        <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="flex flex-col items-center md:flex-row">
                    <div class="md:w-3/5 md:mr-6">
                        <form method="post" action="{{ route('driver.carpool_vehicles.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <!-- Carpool Driver ID (Hidden) -->
                                <input type="hidden" name="carpool_driver_id"
                                    value="{{ Auth::user()->carpoolDriver->id }}">
                                <!-- Make -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                                    <input type="text" name="make" id="make" type="text"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('make', '') }}" />
                                    @error('make')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Model -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                                    <input type="text" name="model" id="model" type="text"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('model', '') }}" />
                                    @error('model')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Vehicle Year -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="year" class="block text-sm font-medium text-gray-700">Vehicle
                                        Year</label>
                                    <input type="text" name="year" id="year" type="text"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('year', '') }}" />
                                    @error('year')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Number Plate -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="number_plate" class="block text-sm font-medium text-gray-700">Number
                                        Plate</label>
                                    <input type="text" name="number_plate" id="number_plate" type="text"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('number_plate', '') }}" />
                                    @error('number_plate')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Capacity -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="capacity"
                                        class="block text-sm font-medium text-gray-700">Capacity</label>
                                    <input type="number" min="1" max="1000" name="capacity" id="capacity"
                                        type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('capacity', '') }}" />
                                    @error('capacity')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Vehicle Photo -->
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="vehicle_photo" class="block text-sm font-medium text-gray-700">Vehicle
                                        Photo</label>
                                    <div class="text-sm text-gray-600">
                                        <p>Upload a photo of your vehicle. For the best view, the width should be the
                                            same as the height, (e.g. 256 x 256)</p>
                                    </div>
                                    <input type="file" name="vehicle_photo" id="vehicle_photo"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input" />
                                    @error('vehicle_photo')
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
                    <!-- Vehicle Photo Display -->
                    <div class="flex items-center justify-center mt-6 md:mt-0 md:w-2/5">
                        <div class="w-full max-w-md">
                            <div class="bg-white shadow sm:rounded-md">
                                <div class="px-4 py-5 sm:p-6">
                                    <label for="vehicle_photo" class="block text-sm font-medium text-gray-700">Vehicle
                                        Photo</label>
                                    <img id="vehicle_photo_preview" src="{{ asset('images/car_placeholder.png') }}"
                                        alt="Vehicle Photo" class="w-full h-auto mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
<script>
    document.getElementById('vehicle_photo').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('vehicle_photo_preview').src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
