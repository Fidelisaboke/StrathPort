<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link href="{{ route('carpooling_details.index') }}" :active="request()->routeIs('carpooling_details.index')">
        {{ __('Carpool Schedules') }}
    </x-nav-link>
    <x-nav-link href="{{ route('carpool_requests.index') }}" :active="request()->routeIs('carpool_requests.index')">
        {{ __('Carpool Requests') }}
    </x-nav-link>
    <x-nav-link href="{{ route('carpool_vehicles.index') }}" :active="request()->routeIs('carpool_vehicles.index')">
        {{ __('Vehicle Information') }}
    </x-nav-link>
</div>
