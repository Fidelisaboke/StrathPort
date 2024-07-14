<div class="flex flex-col justify-between p-4 mb-8 bg-white rounded-lg shadow-xl lg:mb-0">
    <h2 class="text-lg font-semibold text-gray-800">Carpool Vehicle</h2>
    <div class="flex flex-col text-sm leading-3">
        <figure class="flex flex-col p-6 rounded-lg md:space-x-10 md:flex-row">
            @if (!empty($carpoolVehicle->vehicle_photo_path))
                <figcaption class="flex items-center justify-center space-x-4">
                    <div class="flex flex-col items-center">
                        <!-- Vehicle Image -->
                        <img src="{{ $carpoolVehicle->vehicle_photo_url }}" alt="Vehicle Photo"
                            class="w-48 h-48 rounded-md">
                    </div>
                </figcaption>
            @else
                <figcaption class="flex items-center justify-center space-x-4">
                    <div class="flex flex-col items-center">
                        <!-- Vehicle Image -->
                        <img src="{{ asset('images/car_placeholder.png') }}" alt="Vehicle Photo"
                            class="w-48 h-48 rounded-md">
                    </div>
                </figcaption>
            @endif
            <blockquote class="mt-2 text-slate-700">
                <div class="flex flex-col">
                    @if (!empty($carpoolVehicle))
                        <div class="flex-auto">
                            <div class="text-lg font-semibold text-center text-slate-900">
                                {{ $carpoolVehicle->full_name }}
                            </div>
                        </div>
                        <p class="mt-4 text-lg"><span class="text-black">Year: </span>{{ $carpoolVehicle->year }}
                        </p>
                        <p class="mt-4 text-lg"><span class="text-black">Number Plate:
                            </span>{{ $carpoolVehicle->number_plate }}</p>
                        <p class="mt-4 text-lg"><span class="text-black">Capacity:
                            </span>{{ $carpoolVehicle->capacity }}</p>
                    @else
                        <p class="text-lg text-center">You have not added your vehicle details yet.</p>
                    @endif
                </div>
            </blockquote>
        </figure>
    </div>
    <div class="flex flex-row items-center justify-end mt-2">
        @if (!empty($carpoolVehicle))
            <a href="{{ route('driver.carpool_vehicles.index') }}"
                class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
                View Vehicle Details
                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @else
            <a href="{{ route('driver.carpool_vehicles.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
                Add Your Vehicle Details
            </a>
        @endif
    </div>

</div>
