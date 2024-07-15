<div class="flex flex-col justify-between mb-8 bg-white rounded-lg shadow-xl">
    <h2 class="p-4 text-lg font-semibold">Upcoming Carpool Trips</h2>
    @if (empty($carpoolingDetails) || $carpoolingDetails->isEmpty())
        <div class="p-6 px-0 mt-4 space-y-4 md:mt-0">
            <div class="flex flex-col items-center justify-center">
                <p class="p-2 mx-auto text-lg font-semibold text-center text-gray-900 bg-gray-200 rounded-full">
                    No upcoming carpool trips!</p>
            </div>
        </div>
    @else
        <div class="p-6 px-0 mt-4 space-y-4 overflow-scroll md:mt-0">
            <h2 class="p-2 font-semibold text-gray-600 text-md">Next 3 trips...</h2>
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <!-- Description -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Title <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Date -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Date <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Time -->
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p
                                class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Time <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
                                Actions <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carpoolingDetails as $carpoolingDetail)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolingDetail->carpoolRequest->title }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolingDetail->carpoolRequest->departure_date }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $carpoolingDetail->carpoolRequest->departure_time }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <!-- view -->
                                <a href="{{ route('driver.carpooling_details.show', $carpoolingDetail->id) }}"
                                    class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- View Full Schedule Button -->
    <div class="flex flex-row items-center justify-end px-2 py-4">
        <a href="{{ route('driver.carpooling_details.index') }}"
            class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
            View Full Schedule
            <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>

</div>
