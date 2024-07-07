<x-confirmation-modal wire:model="showModal">
    <x-slot name="title">
        {{ __('Confirm Cancel') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to cancel?') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showModal', false)">
            {{ __('No') }}
        </x-secondary-button>

        <x-danger-button wire:click="cancelTrip" class="ms-2">
            {{ __('Yes') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
