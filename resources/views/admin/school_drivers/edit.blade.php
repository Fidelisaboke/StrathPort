<x-admin-app-layout>
    <x-slot name="title">
        Edit School Driver
    </x-slot>

    <x-status-message />

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.school_drivers.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to School Drivers List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <form method="post" action="{{ route('admin.school_drivers.update', $schoolDriver) }}">
                @csrf
                @method('PUT')
                <div class="overflow-hidden shadow sm:rounded-md">
                    <!-- First Name -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('first_name', $schoolDriver->first_name) }}" />
                        @error('first_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Last Name -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('last_name', $schoolDriver->last_name) }}" />
                        @error('last_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Phone Number -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone" id="phone" type="text"
                            class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('phone', $schoolDriver->phone) }}" />
                        @error('phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Availability Status -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="availability_status" class="block text-sm font-medium text-gray-700">Availability Status</label>
                        <select name="availability_status" id="availability_status"
                            class="block w-full mt-1 rounded-md shadow-sm form-select">
                            <option value="Available"
                                {{ old('availability_status', $schoolDriver->availability_status) == 'Available' ? 'selected' : '' }}>
                                Available</option>
                            <option value="Unavailable"
                                {{ old('availability_status', $schoolDriver->availability_status) == 'Unavailable' ? 'selected' : '' }}>
                                Unavailable</option>
                        </select>
                        @error('availability_status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                            Update
                        </button>
                    </div>
                </div>
</x-admin-app-layout>
