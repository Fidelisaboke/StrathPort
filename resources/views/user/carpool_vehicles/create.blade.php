<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add Your Vehicle Details
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('carpool_vehicles.store') }}">
                    @csrf
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- Carpool Driver ID (Hidden) -->
                        <input type="hidden" name="user_id" value="{{ Auth::user()->carpoolDriver->id }}">
                        <!-- Make -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                            <input type="text" name="make" id="make" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('make', '') }}" />
                            @error('make')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Model -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="model" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="model" id="model" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('model', '') }}" />
                            @error('model')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Vehicle Year -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="year" class="block text-sm font-medium text-gray-700">Vehicle Year</label>
                            <input type="text" name="year" id="year" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('year', '') }}" />
                            @error('year')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Number Plate -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="number_plate" class="block text-sm font-medium text-gray-700">Number Plate</label>
                            <input type="text" name="number_plate" id="number_plate" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('number_plate', '') }}" />
                            @error('number_plate')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Capacity -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input type="number" min="1" max="1000" name="capacity" id="capacity" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('capacity', '') }}" />
                            @error('capacity')
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
            </div>
        </div>
    </div>
</x-app-layout>
