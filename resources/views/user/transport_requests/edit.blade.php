<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Transport Request
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('transport_requests.update', $transportRequest->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <!-- Title -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('title', $transportRequest->title) }}" />
                            @error('title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description" id="description" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('description', $transportRequest->description) }}" />
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Date -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                            <input type="date" name="event_date" id="event_date" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('event_date', $transportRequest->event_date) }}" />
                            @error('event_date')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="event_time" class="block text-sm font-medium text-gray-700">Event Time</label>
                            <input type="time" name="event_time" id="event_time" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('event_time', $transportRequest->event_time) }}" />
                            @error('event_time')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Location -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="event_location" class="block text-sm font-medium text-gray-700">Event Location</label>
                            <input type="text" name="event_location" id="event_location" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('event_location', $transportRequest->event_location) }}" />
                            @error('event_location')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- No of People -->
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="no_of_people" class="block text-sm font-medium text-gray-700">Number of People Expected</label>
                            <input type="number" min="1" max="1000" name="no_of_people" id="no_of_people" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                                   value="{{ old('no_of_people', $transportRequest->no_of_people) }}" />
                            @error('no_of_people')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
