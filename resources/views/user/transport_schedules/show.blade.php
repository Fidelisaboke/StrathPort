<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vie Transport Schedule') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <x-button-link href="{{ route('transport_schedules.index') }}" text="Back to Transport Schedules List" arrowType="left"/>


            <div class="container grid px-6 mx-auto md:w-3/5">
                <div class="items-center p-4 my-6">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- ID -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->id }}</span>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->description }}</span>
                            </div>
                        </div>
                        <!-- Date -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="event_date" class="block text-sm font-medium text-gray-700">Date</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->schedule_date }}</span>
                            </div>
                        </div>
                        <!-- Time -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="event_time" class="block text-sm font-medium text-gray-700">Time</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->schedule_time }}</span>
                            </div>
                        </div>
                        <!-- Starting POint -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="starting_location" class="block text-sm font-medium text-gray-700">Starting
                                Point</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->starting_point }}</span>
                            </div>
                        </div>
                        <!-- Destination -->
                        <div class="px-4 py-2 bg-white border-b sm:p-6">
                            <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                            <div class="flex justify-between">
                                <span>{{ $transportSchedule->destination }}</span>
                            </div>
                        </div>
                        {{-- TODO: Add School Vehicle and School Driver details for the schedule - --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
