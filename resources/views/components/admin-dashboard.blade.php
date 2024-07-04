<x-admin-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
        <!-- Total Users Card -->
        <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
            <a href="{{ route('admin.users.index') }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-fuchsia-600">{{$totalUsers}}</span>
                        <span class="ml-4 font-semibold text-gray-600">Users</span>
                    </div>
                    <div class="p-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- Total Transport Requests -->
        <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
            <a href="{{ route('admin.transport_requests.index') }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-fuchsia-600">{{$totalTransportRequests}}</span>
                        <span class="ml-4 font-semibold text-gray-600">Transport Requests</span>
                    </div>
                    <div class="p-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
            </a>
        </div>

</x-admin-app-layout>

