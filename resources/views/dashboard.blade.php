<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            @can('view student dashboard')
                <x-student-dashboard />
            @endcan
            @can('view staff dashboard')
                <x-staff-dashboard />
            @endcan
            @can('view carpool driver dashboard')
                <x-carpool-driver-dashboard />
            @endcan
        </div>
    </div>
</x-app-layout>
