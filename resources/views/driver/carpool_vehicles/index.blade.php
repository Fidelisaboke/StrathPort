<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Vehicle Information
        </h2>
    </x-slot>

    <x-status-message/>

    @php
        $carpoolVehicle = Auth::user()->carpoolDriver->carpoolVehicle;
    @endphp

    <div class="py-12">
        <div class="mx-auto md:w-3/5 w max-w-7xl sm:px-6 lg:px-8">
            @empty($carpoolVehicle)
                <a href="{{route('driver.carpool_vehicles.create')}}" class="flex flex-row justify-center px-4 py-2 mx-8 mb-4 font-bold text-white rounded md:mx-0 bg-fuchsia-600 hover:bg-fuchsia-700">Add Your Vehicle Details</a>
            @else
                <div class="p-4 mx-auto bg-white rounded-lg shadow-xl">
                    <h2 class="mb-4 text-lg font-semibold text-center text-gray-800">Carpool Vehicle</h2>
                    <x-carpool-vehicle-index-card :carpool-vehicle='$carpoolVehicle'/>
                </div>
            @endempty
        </div>
    </div>
</x-app-layout>
