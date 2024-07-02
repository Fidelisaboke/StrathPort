<x-form-section submit="update">
    <x-slot name="title">
        {{ __('Student Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your first name and last name.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Staff School ID -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="student_school_id" value="{{ __('Staff School ID') }}" />
            <x-input id="student_school_id" type="text" class="block w-full mt-1" wire:model="state.student_school_id" required autocomplete="student_school_id" />
            @error('student_school_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

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
