<div class="mb-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
    <!-- Transport Requests Table -->
    <div class="p-6 px-0 overflow-scroll">
        <table class="w-full mt-4 text-left table-auto min-w-max">
            <thead>
                <tr>
                    <!-- id -->
                    <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                        <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">ID <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                        </p>
                    </th>
                    <!-- Title -->
                    <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                        <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Title <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
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
                    <!-- Location -->
                    <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                        <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Location <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                        </p>
                    </th>
                    <!-- No of people -->
                    <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                        <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">No of people <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                        </p>
                    </th>
                    <!-- Status -->
                    <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                        <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Status <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
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
                @foreach($transportRequests as $transportRequest)
                <tr>
                    <!-- ID -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->id}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- Title -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->title}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- Date -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->event_date}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- Time -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->event_time}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- Location -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->event_location}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- No of people -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$transportRequest->no_of_people}}</p>
                        </div>
                        </div>
                    </td>
                    <!-- Status -->
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                        @if($transportRequest->status == 'Pending')
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-yellow-600 uppercase rounded-md select-none whitespace-nowrap bg-yellow-500/20" style="opacity: 1;">
                                <p class="block antialiased leading-none text-center">{{$transportRequest->status}}</p>
                            </div>
                        @elseif($transportRequest->status == 'Approved')
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-600 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20" style="opacity: 1;">
                                <p class="block antialiased leading-none text-center">{{$transportRequest->status}}</p>
                            </div>
                        @else
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-red-600 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20" style="opacity: 1;">
                                <p class="block antialiased leading-none text-center">{{$transportRequest->status}}</p>
                            </div>
                        @endif
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <!-- view -->
                        <a href="{{ route('transport_requests.show', $transportRequest->id) }}" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-800">View</a>
                        <!-- edit -->
                        <a href="{{ route('transport_requests.edit', $transportRequest->id) }}" class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-800">Edit</a>
                        <!-- delete -->
                        <form class="inline-block" action="{{ route('transport_requests.destroy', $transportRequest->id) }}" method="POST" x-data>
                            @csrf
                            @method('DELETE')
                            <button @click.prevent="$dispatch('delete', { indexRoute: 'transport_requests.index', id: {{ $transportRequest->id }}, modelClass: 'App\\Models\\TransportRequest'});" type="submit" class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @livewire('delete-confirmation-modal')
    </div>
</div>
