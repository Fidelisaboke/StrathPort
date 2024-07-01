<x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>
<x-responsive-nav-link href="{{ route('carpooling_details.index') }}" :active="request()->routeIs('carpool_schedules.index')">
    {{ __('Carpool Schedules') }}
</x-responsive-nav-link>
<x-responsive-nav-link href="{{ route('carpool_requests.index') }}" :active="request()->routeIs('carpool_requests.index')">
    {{ __('Carpool Requests') }}
</x-responsive-nav-link>
