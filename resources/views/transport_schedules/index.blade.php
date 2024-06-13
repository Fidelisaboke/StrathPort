<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Transport Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 px-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <!-- ID -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">ID <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Description -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Description <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Date -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Date <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Time -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Time <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Starting Point -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Starting Point <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Destination -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Destination <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                                <!-- Actions -->
                                <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                                    <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Actions <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                        </svg>
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transport_schedules as $transport_schedule)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->id}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->description}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->schedule_date}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->schedule_time}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->starting_point}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transport_schedule->destination}}</p>
                                    </div>
                                    </div>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <!-- view -->
                                    <a href="{{ route('transport_schedules.show', $transport_schedule->id) }}" class="px-4 py-2 text-white bg-green-700 rounded hover:bg-green-800">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>