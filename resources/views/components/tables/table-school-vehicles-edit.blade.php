@empty($schoolVehicles)
    <div class="flex items-center justify-center">
        <div class="w-1/2 p-4 mx-auto my-16 text-center bg-white border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700">No school vehicles found!</h2>
            <p class="mt-2 text-gray-500">Please add a new school vehicle.</p>
        </div>
    </div>
@else
    <x-tables.table-links>
        {{ $schoolVehicles->links() }}
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
                        <!-- Make -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Make <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Model -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Model <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Year -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Year <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
                        <!-- Driver -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Driver <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
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
                    @foreach ($schoolVehicles as $schoolVehicle)
                        <tr>
                            <!-- ID -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->id }}</p>
                                    </div>
                            </td>
                            <!-- Make -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->make }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Model -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->model }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Year -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->year }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Number Plate -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->number_plate }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Capacity -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $schoolVehicle->capacity }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Driver -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            @empty($schoolVehicle->schoolDriver)
                                                <span class="text-red-600">No driver assigned</span>
                                            @else
                                                {{ $schoolVehicle->schoolDriver->full_name }}
                                            @endempty
                                        </p>
                                    </div>
                            <!-- Actions -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <!-- view -->
                                <a href="{{ route('admin.school_vehicles.show', $schoolVehicle->id) }}"
                                    class="text-green-600 rounded hover:text-green-800">View</a>
                                <!-- edit -->
                                <a href="{{ route('admin.school_vehicles.edit', $schoolVehicle->id) }}"
                                    class="ml-2 text-indigo-600 rounded hover:text-indigo-800">Edit</a>
                                <!-- delete -->
                                <form class="inline-block"
                                    action="{{ route('admin.school_vehicles.destroy', $schoolVehicle->id) }}"
                                    method="POST" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        @click.prevent="$dispatch('delete', { indexRoute: 'admin.school_vehicles.index', id: {{ $schoolVehicle->id }}, modelClass: 'App\\Models\\SchoolVehicle', adminModule:true });"
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
