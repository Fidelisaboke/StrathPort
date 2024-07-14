@php
    $carpoolVehicle = Auth::user()->carpoolDriver->carpoolVehicle;
@endphp

<div class="overflow-auto lg:gap-8 lg:grid lg:grid-cols-2">
    <div class="p-4 mb-8 bg-white rounded-lg shadow-xl lg:mb-0">
        <h2 class="text-lg font-semibold text-gray-800">User Profile</h2>
        <x-user-profile-card />
    </div>
    <x-carpool-vehicle-card :carpool-vehicle='$carpoolVehicle'/>
    <x-upcoming-carpool-trips-table />
    <x-carpool-trips-status-bar />
</div>
