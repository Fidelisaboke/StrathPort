<x-form-section submit="update">
    <x-slot name="title">
        {{ __('Carpool Driver Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your first name, last name, and availability.') }}
    </x-slot>

    <x-slot name="form">

        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input id="first_name" type="text" class="block w-full mt-1" wire:model="state.first_name" required autocomplete="first_name" />
            @error('first_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" class="block w-full mt-1" wire:model="state.last_name" required autocomplete="last_name" />
            @error('last_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Availability Status-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="availability_status" value="{{ __('Availability Status') }}" />
            <!-- Dropdown -->
            <select class="col-span-6 rounded-lg sm:col-span-4" id="availability_status" name="availability_status" class="block w-full mt-1" wire:model="state.availability_status" required autocomplete="availability_status">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
            @error('availability_status')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
