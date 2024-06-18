<x-confirmation-modal wire:model="showModal">
    <x-slot name="title">
        {{ __('Log Out') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to log out?') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showModal', false)">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button wire:click="logout" class="ms-2">
            {{ __('Log Out') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
