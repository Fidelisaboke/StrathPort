<x-confirmation-modal wire:model="showModal">
    <x-slot name="title">
        {{ __('Confirm Delete') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete?') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showModal', false)">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button wire:click="delete" class="ms-2">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
