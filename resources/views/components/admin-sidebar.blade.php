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
        <x-admin-nav-link href="{{route('admin.users.index')}}" :active="request()->routeIs('admin.users.index')">
            <i class="w-6 h-6 fas fa-users" aria-hidden="true"></i>
            <span class="mx-3">Users</span>
        </x-admin-nav-link>

        <!-- User Roles -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{route('admin.roles.index')}}">
            <i class="w-6 h-6 fas fa-user-tag" aria-hidden="true"></i>
            <span class="mx-3">Roles</span>
        </a>

        <!-- User Permissions -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.permissions.index')}}">
            <i class="w-6 h-6 fas fa-user-cog" aria-hidden="true"></i>
            <span class="mx-3">Permissions</span>
        </a>

        <!-- Transport Requests -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.transport_requests.index')}}">
            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
            <span class="mx-3">Transport Requests</span>
        </a>

        <!-- Transport Schedules -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.transport_schedules.index')}}">
            <i class="w-6 h-6 fas fa-calendar" aria-hidden="true"></i>
            <span class="mx-3">Transport Schedules</span>
        </a>

        <!-- Carpool Drivers -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.school_drivers.index')}}">
            <i class="w-6 h-6 fas fa-id-card" aria-hidden="true"></i>
            <span class="mx-3">Carpool Drivers</span>
        </a>

        <!-- School Drivers -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.school_drivers.index')}}">
            <i class="w-6 h-6 fa fa-id-card" aria-hidden="true"></i>
            <span class="mx-3">School Drivers</span>
        </a>

        <!-- School Vehicles -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('admin.school_vehicles.index')}}">
            <i class="w-6 h-6 fas fa-bus" aria-hidden="true"></i>
            <span class="mx-3">School Vehicles</span>
        </a>

        <!-- School Drivers -->

        <!-- Settings -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{url('user/profile')}}">
            <i class="w-6 h-6 fas fa-cog"></i>
            <span class="mx-3">Settings</span>
        </a>
    </nav>
</div>
