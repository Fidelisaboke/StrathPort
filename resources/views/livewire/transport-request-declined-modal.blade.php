<x-decline-form-modal submit="declineTransportRequest" wire:model="showModal">
    <x-slot name="title">
        {{ __('Confirm Request Declination') }}
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-col">
            {{ __('Describe why the request is being declined:') }}
        <textarea class="mt-2 rounded-md text-slate-900 hover:border-fuchsia-600 focus:border-fuchsia-700 focus:ring-fuchsia-300 active:border-fuchsia-700" wire:model="declinedReason" placeholder="Reason for declining the request..."></textarea>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('showModal', false)">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button type="submit" class="ms-2">
            {{ __('Decline') }}
        </x-danger-button>
    </x-slot>
</x-decline-form-modal>
