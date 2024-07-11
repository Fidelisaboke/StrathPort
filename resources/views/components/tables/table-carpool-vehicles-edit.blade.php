@empty($carpoolVehicles)
    <div class="flex items-center justify-center">
        <div class="w-1/2 p-4 mx-auto my-16 text-center bg-white border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700">No carpool vehicles found!</h2>
            <p class="mt-2 text-gray-500">Please add a new carpool vehicle.</p>
        </div>
    </div>
@else
    <x-tables.table-links>
        {{ $carpoolVehicles->links() }}
    </x-tables.table-links>
    <div class="mb-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <!-- ID -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                ID <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Vehicle Name -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Vehicle Name <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Number Plate -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Number Plate <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Capacity -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Capacity <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Carpool Driver -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Carpool Driver <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Actions -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Actions
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carpoolVehicles as $carpoolVehicle)
                        <tr>
                            <!-- ID -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolVehicle->id }}</p>
                                    </div>
                            </td>
                            <!-- Make -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolVehicle->full_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Number Plate -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolVehicle->number_plate }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Capacity -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolVehicle->capacity }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Driver -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            @empty($carpoolVehicle->carpoolDriver)
                                                <span class="text-red-600">No driver assigned</span>
                                            @else
                                                {{ $carpoolVehicle->carpoolDriver->full_name }}
                                            @endempty
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <!-- Actions -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <!-- view -->
                                <a href="{{ route('admin.carpool_vehicles.show', $carpoolVehicle->id) }}"
                                    class="text-green-600 rounded hover:text-green-800">View</a>
                                <!-- edit -->
                                <a href="{{ route('admin.carpool_vehicles.edit', $carpoolVehicle->id) }}"
                                    class="ml-2 text-indigo-600 rounded hover:text-indigo-800">Edit</a>
                                <!-- delete -->
                                <form class="inline-block"
                                    action="{{ route('admin.carpool_vehicles.destroy', $carpoolVehicle->id) }}"
                                    method="POST" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        @click.prevent="$dispatch('delete', { indexRoute: 'admin.carpool_vehicles.index', id: {{ $carpoolVehicle->id }}, modelClass: 'App\\Models\\CarpoolVehicle', adminModule:true });"
                                        type="submit"
                                        class="ml-2 text-red-600 rounded hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @livewire('delete-confirmation-modal')
        </div>
    </div>
@endempty
