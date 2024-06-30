<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto md:w-full max-w-7xl sm:px-6 lg:px-8">
            @if(Auth::user()->id == 1) {{--Modify Later --}}
                <x-student-staff-dashboard />
            @elseif (Auth::user()->id == 2) {{-- Modify Later --}}
                <x-carpool-driver-dashboard />
            @endif
        </div>
    </div>
</x-app-layout>
