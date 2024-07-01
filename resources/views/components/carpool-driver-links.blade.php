<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link href="{{ route('transport_schedules.index') }}" :active="request()->routeIs('transport_schedules.index')">
        {{ __('Carpool Schedules') }}
    </x-nav-link>
    <x-nav-link href="{{ route('transport_requests.index') }}" :active="request()->routeIs('transport_requests.index')">
        {{ __('Carpool Requests') }}
    </x-nav-link>
</div>
