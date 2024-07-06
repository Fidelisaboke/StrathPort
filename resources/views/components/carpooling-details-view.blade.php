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
                        Time: {{ $carpoolRequest->departure_time }}
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
