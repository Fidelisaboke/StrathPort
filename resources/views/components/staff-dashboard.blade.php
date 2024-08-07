<div class="w-full space-y-8 lg:flex lg:justify-center">
    <div class="lg:flex lg:flex-row lg:items-center lg:space-x-8 xl:space-x-12">
        <div class="p-4 bg-white rounded-lg shadow-xl">
            <h2 class="text-lg font-semibold text-gray-800">User Profile</h2>
            <x-user-profile-card />
        </div>
        <div class="p-4 mt-8 bg-white rounded-lg shadow-xl">
            <h2 class="text-lg font-semibold text-gray-800">Upcoming Trips</h2>
            <x-upcoming-trips-table />
            <!-- View full schedule -->
            <a href="{{ route('transport_schedules.index') }}" class="block w-full p-2 mt-4 text-center text-white rounded-lg bg-fuchsia-700 hover:bg-fuchsia-800">View Full Schedule</a>
        </div>
    </div>
</div>
