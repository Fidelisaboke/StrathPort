<div class="space-y-4 md:gap-8 md:grid-cols-2 md:grid md:space-y-0">
    @empty($carpoolingDetails)
        <p>No carpooling schedules found matching your criteria.</p>
    @else
        @foreach ($carpoolingDetails as $carpoolingDetail)
            @php
                $carpoolRequest = $carpoolingDetail->carpoolRequest;
                $carpoolDriver = $carpoolRequest->carpoolDriver;
            @endphp
            <div class="flex flex-row justify-between p-8 bg-white border-t rounded-lg shadow-xl">
                <div class="flex flex-col">
                    <div class="mb-2 text-xl font-medium">
                        {{ $carpoolRequest->description }}
                    </div>
                    <div class="flex flex-row mb-2">
                        <x-svg.calendar />
                        Date: {{ $carpoolRequest->departure_date }}
                    </div>
                    <div class="flex flex-row mb-2">
                        <x-svg.clock />
                        Time: {{ \Carbon\Carbon::parse($carpoolRequest->departure_time)->format('H:i') }}
                    </div>
                    <div class="flex flex-row mb-2">
                        <x-svg.location-dot />
                        Departure Location: {{ $carpoolRequest->departure_location }}
                    </div>
                    <div class="flex flex-row mb-2">
                        <x-svg.location-dot-fill />
                        Destination: {{ $carpoolRequest->destination }}
                    </div>
                    <div class="flex flex-row mb-2">
                        <x-svg.id-card />

                        Driver: {{ $carpoolDriver->full_name }}
                    </div>
                    <div class="flex flex-row mb-2">
                        @if($carpoolingDetail->status == 'Completed')
                            <div class="flex flex-row flex-wrap items-center space-x-1">
                                <span class="font-medium text-gray-800 text-md">Status: </span>
                                <div class="flex flex-row px-2 py-1 bg-green-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.89163 13.2687L9.16582 17.5427L18.7085 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="text-white rounded-full">Completed</span>
                                </div>
                            </div>
                        @elseif($carpoolingDetail->status == 'Cancelled')
                        <div class="flex flex-row flex-wrap items-center space-x-1">
                            <span class="font-medium text-gray-800 text-md">Status: </span>
                            <div class="flex flex-row px-2 py-1 bg-red-600 rounded-full">
                                <svg class="w-6 h-6 text-white" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.75827 17.2426L12.0009 12M17.2435 6.75736L12.0009 12M12.0009 12L6.75827 6.75736M12.0009 12L17.2435 17.2426" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-white rounded-full">Cancelled</span>
                            </div>
                        </div>
                        @else
                            <div class="flex flex-row flex-wrap items-center space-x-1">
                                <span class="font-medium text-gray-800 text-md">Status: </span>
                                <div class="flex flex-row flex-wrap px-2 py-1 bg-yellow-600 rounded-full">
                                    <svg class="w-6 h-6 text-white" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.2721 3.13079L17.4462 6.15342C17.6461 6.66824 17.3909 7.24768 16.8761 7.44764L13.8535 8.6217" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                        <path d="M7.61555 20.5111L6.93391 17.3409C6.81782 16.801 7.16142 16.2692 7.70136 16.1531L10.8715 15.4714" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9153 7.86755C17.6501 7.5052 17.8749 6.55584 17.263 6.01119C16.4869 5.32046 15.5626 4.77045 14.5169 4.41551C10.3331 2.99538 5.79017 5.23581 4.37005 9.41964C4.01511 10.4653 3.88883 11.5335 3.96442 12.5696C4.02402 13.3867 4.9141 13.7862 5.64883 13.4239V13.4239C6.17327 13.1652 6.44536 12.5884 6.44406 12.0037C6.44274 11.4136 6.53712 10.8132 6.73739 10.2232C7.71372 7.34681 10.837 5.80651 13.7134 6.78285C14.3034 6.98311 14.8371 7.27371 15.3045 7.63397C15.7677 7.99095 16.3909 8.12619 16.9153 7.86755V7.86755ZM6.97575 16.1145C7.50019 15.8558 8.12343 15.991 8.58656 16.348C9.05394 16.7083 9.58773 16.9989 10.1777 17.1992C13.0541 18.1755 16.1774 16.6352 17.1537 13.7588C17.354 13.1688 17.4483 12.5684 17.447 11.9783C17.4457 11.3936 17.7178 10.8168 18.2423 10.5581V10.5581C18.977 10.1958 19.8671 10.5953 19.9267 11.4124C20.0022 12.4485 19.876 13.5167 19.521 14.5624C18.1009 18.7462 13.558 20.9866 9.37418 19.5665C8.32849 19.2116 7.4042 18.6615 6.62812 17.9708C6.01616 17.4262 6.24102 16.4768 6.97575 16.1145V16.1145Z" fill="currentColor"/>
                                    </svg>
                                    <span class="text-white rounded-full">In Progress</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    @if(Auth::user()->hasRole('carpool_driver'))
                        <div>
                            <a href="{{ route('driver.carpooling_details.show', $carpoolingDetail->id) }}"
                                class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">View</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('carpooling_details.show', $carpoolingDetail->id) }}"
                                class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">View</a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        @endforelse
    </div>
