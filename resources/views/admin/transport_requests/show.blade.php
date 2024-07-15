<x-admin-app-layout>
    <x-slot name="title">
        Transport Request Details
    </x-slot>

    @php
        $roles = Spatie\Permission\Models\Role::all();
        $user = $transportRequest->user;
        $fullName;
        if ($user->hasRole('student') && !empty($user->student->full_name)) {
            $fullName = $user->student->full_name;
        } elseif ($user->hasRole('staff') && !empty($user->staff->full_name)) {
            $fullName = $user->staff->full_name;
        }
    @endphp

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.transport_requests.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to Transport Requests List
        </a>
    </div>

    <div class="container grid px-6 mx-auto md:w-3/5">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- Request From -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="user" class="block text-sm font-medium text-gray-700">Request From</label>
                    <div class="flex justify-between">
                        <span>
                            @empty($fullName)
                                <a href="{{ url('admin/users/' . $transportRequest->user_id) }}" class="hover:underline">{{ $user->name }}</a>
                            @else
                                <a href="{{ url('admin/users/' . $transportRequest->user_id) }}" class="hover:underline">{{ $fullName }}</a>
                            @endempty
                        </span>
                    </div>
                </div>
                <!-- ID -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="user" class="block text-sm font-medium text-gray-700">Request ID</label>
                    <div class="flex justify-between">
                        <span>{{ $transportRequest->id }}</span>
                    </div>
                </div>
                <!-- Title -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="flex justify-between">
                        <span>{{ $transportRequest->title }}</span>
                    </div>
                </div>
                <!-- Description -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="flex justify-between">
                        <span>{{ $transportRequest->description }}</span>
                    </div>
                </div>
                <!-- Date -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <div class="flex justify-start">
                        <span>{{ $transportRequest->event_date }}</span>
                    </div>
                </div>
                <!-- Time -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                    <div class="flex justify-between">
                        <span>{{ $transportRequest->event_time }}</span>
                    </div>
                </div>
                <!-- Event Location -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="event_location" class="block text-sm font-medium text-gray-700">Event Location</label>
                    <div class="flex justify-between">
                        <span>{{ $transportRequest->event_location }}</span>
                    </div>
                </div>
                <!-- Status -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="flex flex-col">
                        <span>{{ $transportRequest->status }}</span>
                        @if ($transportRequest->status == 'Pending')
                            <div class="flex justify-center mt-4">
                                <form
                                    action="{{ route('admin.transport_requests.update_status', $transportRequest->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit"
                                        class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Approve</button>
                                </form>
                                <form
                                    action="{{ route('admin.transport_requests.update_status', $transportRequest->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Declined">
                                    <button type="submit"
                                        class="px-4 py-2 ml-4 text-white bg-red-500 rounded hover:bg-red-600">Decline</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
