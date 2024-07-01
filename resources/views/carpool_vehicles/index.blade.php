<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Vehicle Information
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{route('carpool_vehicles.create')}}" class="flex flex-row justify-center px-4 py-2 mx-8 mb-4 font-bold text-white rounded md:mx-0 bg-fuchsia-600 hover:bg-fuchsia-700">Add Your Vehicle Details</a>
            <div class="p-4 bg-white rounded-lg shadow-xl">
                <h2 class="text-lg font-semibold text-gray-800">User Profile</h2>
                    <x-vehicle-info-card />
            </div>
        </div>
    </div>
</x-app-layout>
