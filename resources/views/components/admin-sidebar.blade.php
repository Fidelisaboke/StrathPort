<!-- Sidebar -->
<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex flex-col items-center">
                <a href="{{url('user/profile')}}">
                    <img class="object-cover w-20 h-20 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </a>
                <span class="mt-2 text-2xl font-semibold text-white">{{ Auth::user()->name }}</span>
        </div>
    </div>

    <nav class="mt-10">
        <!-- Dashboard -->
        <x-admin-nav-link href="{{url('dashboard')}}" :active="request()->routeIs('dashboard')">
            <i class="w-6 h-6 fas fa-tachometer-alt"></i>
            <span class="mx-3">Dashboard</span>
        </x-admin-nav-link>

        <!-- Users -->
        <x-admin-nav-link href="{{route('admin.users.index')}}" :active="request()->routeIs('admin.users.*')">
            <i class="w-6 h-6 fas fa-users-cog" aria-hidden="true"></i>
            <span class="mx-3">User Management</span>
        </x-admin-nav-link>

        <!-- Transport Requests -->
        <x-admin-nav-link href="{{route('admin.transport_requests.index')}}" :active="request()->routeIs('admin.transport_requests.*')">
            <i class="w-6 h-6 fas fa-calendar" aria-hidden="true"></i>
            <span class="mx-3">Transport Requests</span>
        </x-admin-nav-link>

        <!-- Transport Schedules -->
        <x-admin-nav-link href="{{route('admin.transport_schedules.index')}}" :active="request()->routeIs('admin.transport_schedules.*')">
            <i class="w-6 h-6 fas fa-calendar" aria-hidden="true"></i>
            <span class="mx-3">Transport Schedules</span>
        </x-admin-nav-link>

        <!-- School Drivers -->
        <x-admin-nav-link href="{{route('admin.school_drivers.index')}}" :active="request()->routeIs('admin.school_drivers.*')">
            <i class="w-6 h-6 fas fa-id-card" aria-hidden="true"></i>
            <span class="mx-3">School Drivers</span>
        </x-admin-nav-link>

        <!-- School Vehicles -->
        <x-admin-nav-link href="{{route('admin.school_vehicles.index')}}" :active="request()->routeIs('admin.school_vehicles.*')">
            <i class="w-6 h-6 fas fa-bus" aria-hidden="true"></i>
            <span class="mx-3">School Vehicles</span>
        </x-admin-nav-link>

        <!-- Carpool Drivers -->
        <x-admin-nav-link href="{{route('admin.carpool_drivers.index')}}" :active="request()->routeIs('admin.carpool_drivers.*')">
            <i class="w-6 h-6 fas fa-id-card" aria-hidden="true"></i>
            <span class="mx-3">Carpool Drivers</span>
        </x-admin-nav-link>

        <!-- Carpool Vehicles -->
        <x-admin-nav-link href="{{route('admin.carpool_vehicles.index')}}" :active="request()->routeIs('admin.carpool_vehicles.*')">
            <i class="w-6 h-6 fas fa-bus" aria-hidden="true"></i>
            <span class="mx-3">Carpool Vehicles</span>
        </x-admin-nav-link>

        <!-- Settings -->
        <x-admin-nav-link href="{{url('user/profile')}}" :active="request()->routeIs('profile.show')">
            <i class="w-6 h-6 fas fa-cog"></i>
            <span class="mx-3">Settings</span>
        </x-admin-nav-link>
    </nav>
</div>
