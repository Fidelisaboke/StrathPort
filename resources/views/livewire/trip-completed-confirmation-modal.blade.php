<x-confirmation-modal wire:model="showModal">
    <x-slot name="title">
        {{ __('Confirm Trip Completion') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to complete this trip?') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showModal', false)">
            {{ __('No') }}
        </x-secondary-button>

        <x-button wire:click="completeTrip" class="ms-2">
            {{ __('Yes') }}
        </x-button>
    </x-slot>
</x-confirmation-modal>
