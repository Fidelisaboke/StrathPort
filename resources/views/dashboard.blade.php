@if(Auth::user()->hasRole('admin'))
    @can('view admin dashboard')
        <x-admin-dashboard />
    @endcan
@else
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto max-w-7xl md:w-full sm:px-8 lg:px-10">
            @if(!Auth::user()->hasAnyRole('student', 'staff', 'carpool_driver') || Auth::user()->account_status !== 'active')
                <x-welcome />
            @else
                @can('view student dashboard')
                    <x-student-dashboard />
                @endcan
                @can('view staff dashboard')
                    <x-staff-dashboard />
                @endcan
                @can('view carpool driver dashboard')
                    <x-carpool-driver-dashboard />
                @endcan
             @endif
        </div>
    </div>
</x-app-layout>
@endif
