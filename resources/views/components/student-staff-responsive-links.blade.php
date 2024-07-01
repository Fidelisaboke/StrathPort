<x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>
<x-responsive-nav-link href="{{ route('transport_schedules.index') }}" :active="request()->routeIs('transport_schedules.index')">
    {{ __('Transport Schedules') }}
</x-responsive-nav-link>
<!-- This link is only available to students -->
<x-responsive-nav-link href="{{ route('transport_requests.index') }}" :active="request()->routeIs('transport_requests.index')">
    {{ __('Transport Requests') }}
</x-responsive-nav-link>
<x-responsive-nav-link href="{{ route('carpool_requests.index') }}" :active="request()->routeIs('carpool_requests.index')">
    {{ __('Carpool Requests') }}
</x-responsive-nav-link>
