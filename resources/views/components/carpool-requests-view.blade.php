<ul class="w-4/5 mx-auto mt-4 space-y-4 md:w-full md:gap-8 md:grid sm:rounded-md md:grid-cols-2 md:space-y-0">
    @foreach($carpoolRequests as $carpoolRequest)
        <li class="p-4 bg-white rounded-lg shadow-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{$carpoolRequest->title}}</h3>
                </div>
                <div class="mt-2 space-y-2 overflow-auto">
                    <p class="max-w-2xl mt-1 text-sm text-gray-500">{{$carpoolRequest->description}}</p>
                    <!-- TODO: Add carpool driver -->
                    <div class="flex flex-row flex-wrap">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                        </svg>
                        <p class="text-gray-800 text-md">Date: {{$carpoolRequest->departure_date}}</p>
                    </div>
                    <div class="flex flex-row flex-wrap">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <p class="text-gray-800 text-md">Time: {{$carpoolRequest->departure_time}}</p>
                    </div>
                    <div class="flex flex-row">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="none" viewBoxmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                <path d="M 45 90 c -1.062 0 -2.043 -0.561 -2.583 -1.475 l -4.471 -7.563 c -9.222 -15.591 -17.933 -30.317 -20.893 -36.258 c -2.086 -4.277 -3.138 -8.852 -3.138 -13.62 C 13.916 13.944 27.86 0 45 0 c 17.141 0 31.085 13.944 31.085 31.084 c 0 4.764 -1.051 9.339 -3.124 13.596 c -0.021 0.042 -0.042 0.083 -0.063 0.124 c -3.007 6.005 -11.672 20.654 -20.843 36.159 l -4.472 7.563 C 47.044 89.439 46.062 90 45 90 z M 45 6 C 31.168 6 19.916 17.253 19.916 31.084 c 0 3.848 0.847 7.539 2.518 10.969 c 2.852 5.721 11.909 21.033 20.667 35.839 L 45 81.104 l 1.89 -3.196 c 8.763 -14.813 17.823 -30.131 20.687 -35.879 c 0.012 -0.022 0.023 -0.045 0.035 -0.067 c 1.642 -3.406 2.474 -7.065 2.474 -10.877 C 70.085 17.253 58.832 6 45 6 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 45 44.597 c -8.076 0 -14.646 -6.57 -14.646 -14.646 S 36.924 15.306 45 15.306 c 8.075 0 14.646 6.57 14.646 14.646 S 53.075 44.597 45 44.597 z M 45 21.306 c -4.767 0 -8.646 3.878 -8.646 8.646 s 3.878 8.646 8.646 8.646 c 4.768 0 8.646 -3.878 8.646 -8.646 S 49.768 21.306 45 21.306 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            </g>
                        </svg>
                        <p class="text-gray-800 text-md">Location: {{$carpoolRequest->departure_location}}</p>
                    </div>
                    <div class="flex flex-row">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        <p class="text-gray-800 text-md">No of people: {{$carpoolRequest->no_of_people}}</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-between mt-4">
                    @if($carpoolRequest->status == 'Approved')
                        <div class="flex flex-row flex-wrap items-center space-x-1">
                            <span class="font-medium text-gray-800 text-md">Status: </span>
                            <div class="flex flex-row px-2 py-1 bg-green-600 rounded-full">
                                <svg class="w-6 h-6 text-white" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.89163 13.2687L9.16582 17.5427L18.7085 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-white rounded-full">Approved</span>
                            </div>
                        </div>
                    @elseif($carpoolRequest->status == 'Declined')
                    <div class="flex flex-row flex-wrap items-center space-x-1">
                        <span class="font-medium text-gray-800 text-md">Status: </span>
                        <div class="flex flex-row px-2 py-1 bg-red-600 rounded-full">
                            <svg class="w-6 h-6 text-white" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.75827 17.2426L12.0009 12M17.2435 6.75736L12.0009 12M12.0009 12L6.75827 6.75736M12.0009 12L17.2435 17.2426" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-white rounded-full">Declined</span>
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
                                <span class="text-white rounded-full">Pending</span>
                            </div>
                        </div>
                    @endif
                    <div class="flex flex-col justify-end space-y-2 md:flex-row md:space-x-2 md:space-y-0">
                        @if(Auth::user()->hasRole('carpool_driver'))
                            <a href="{{ route('driver.carpool_requests.show', $carpoolRequest->id) }}" class="px-4 py-2 font-medium text-green-600 rounded-md hover:text-green-500 hover:bg-gray-100">View</a>
                            <!-- delete -->
                            <form class="inline-block" action="{{ route('driver.carpool_requests.destroy', $carpoolRequest->id) }}" method="POST" x-data>
                                @csrf
                                @method('DELETE')
                                <button @click.prevent="$dispatch('delete', { indexRoute: 'driver.carpool_requests.index', id: {{ $carpoolRequest->id }}, modelClass: 'App\\Models\\CarpoolRequest'});" type="submit" class="px-4 py-2 font-medium text-red-600 rounded hover:text-red-500 hover:bg-gray-100">Delete</button>
                            </form>
                        @else
                            <a href="{{ route('carpool_requests.show', $carpoolRequest->id) }}" class="px-4 py-2 font-medium text-green-600 rounded-md hover:text-green-500 hover:bg-gray-100">View</a>
                            <a href="{{ route('carpool_requests.edit', $carpoolRequest->id) }}" class="px-4 py-2 font-medium text-indigo-600 rounded-md hover:text-indigo-500 hover:bg-gray-100">Edit</a>
                            <!-- delete -->
                            <form class="inline-block" action="{{ route('carpool_requests.destroy', $carpoolRequest->id) }}" method="POST" x-data>
                                @csrf
                                @method('DELETE')
                                <button @click.prevent="$dispatch('delete', { indexRoute: 'carpool_requests.index', id: {{ $carpoolRequest->id }}, modelClass: 'App\\Models\\CarpoolRequest'});" type="submit" class="px-4 py-2 font-medium text-red-600 rounded hover:text-red-500 hover:bg-gray-100">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
@livewire('delete-confirmation-modal')
