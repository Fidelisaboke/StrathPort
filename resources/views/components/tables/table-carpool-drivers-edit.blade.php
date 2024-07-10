@empty($carpoolDrivers)
    <div class="flex items-center justify-center">
        <div class="w-1/2 p-4 mx-auto my-16 text-center bg-white border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700">No carpool drivers found!</h2>
            <p class="mt-2 text-gray-500">Please add a new carpool driver.</p>
        </div>
    </div>
@else
    <x-tables.table-links>
        {{ $carpoolDrivers->links() }}
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
                        <!-- First Name -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                First Name <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Last Name -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Last Name <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Availability Status -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Availability Status <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
                    @foreach ($carpoolDrivers as $carpoolDriver)
                        <tr>
                            <!-- ID -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolDriver->id }}</p>
                                    </div>
                            </td>
                            <!-- First Name -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolDriver->first_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Last Name -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolDriver->last_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <!-- Availability Status -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    @if ($carpoolDriver->availability_status == 'Available')
                                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-600 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20"
                                            style="opacity: 1;">
                                            <p class="block antialiased leading-none text-center">
                                                {{ $carpoolDriver->availability_status}}</p>
                                        </div>
                                    @elseif($carpoolDriver->availability_status == 'Unavailable')
                                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-red-600 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20"
                                            style="opacity: 1;">
                                            <p class="block antialiased leading-none text-center">
                                                {{ $carpoolDriver->availability_status }}</p>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <!-- Actions -->
                            <td class="p-4 border-b border-blue-gray-50">
                                <!-- view -->
                                <a href="{{ route('admin.carpool_drivers.show', $carpoolDriver->id) }}"
                                    class="text-green-600 rounded hover:text-green-800">View</a>
                                <!-- edit -->
                                <a href="{{ route('admin.carpool_drivers.edit', $carpoolDriver->id) }}"
                                    class="ml-2 text-indigo-600 rounded hover:text-indigo-800">Edit</a>
                                <!-- delete -->
                                <form class="inline-block"
                                    action="{{ route('admin.carpool_drivers.destroy', $carpoolDriver->id) }}"
                                    method="POST" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        @click.prevent="$dispatch('delete', { indexRoute: 'admin.carpool_drivers.index', id: {{ $carpoolDriver->id }}, modelClass: 'App\\Models\\CarpoolDriver', adminModule:true });"
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
