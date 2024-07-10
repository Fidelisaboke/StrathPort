<x-admin-app-layout>
    <x-slot name="title">
        Admin Dashboard
    </x-slot>

    <!-- Dashboard Content -->
    <div class="flex flex-col">
        <h1 class="text-3xl font-medium text-gray-700">Quick Overview</h1>
        <div class="justify-center md:flex-row md:flex">
            <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
                <!-- Total Users Card -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.users.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalUsers}}</span>
                                <span class="ml-4 font-semibold text-gray-600">Users</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
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
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Total Transport Schedules -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.transport_schedules.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalTransportSchedules}}</span>
                                <span class="ml-4 font-semibold text-gray-600">Transport Schedules</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Total School Drivers -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.school_drivers.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalSchoolDrivers}}</span>
                                <span class="ml-4 font-semibold text-gray-600">School Drivers</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Total School Vehicles -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.school_vehicles.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalSchoolVehicles}}</span>
                                <span class="ml-4 font-semibold text-gray-600">School Vehicles</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-bus"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Total Carpool Drivers -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.carpool_drivers.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalcarpoolDrivers}}</span>
                                <span class="ml-4 font-semibold text-gray-600">Carpool Drivers</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Total Carpool Vehicles -->
                <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                    <a href="{{ route('admin.carpool_vehicles.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalcarpoolVehicles}}</span>
                                <span class="ml-4 font-semibold text-gray-600">Carpool Vehicles</span>
                            </div>
                            <div class="p-2 ml-2 rounded-full bg-fuchsia-100 text-fuchsia-600">
                                <i class="fas fa-bus"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 py-6">
        <div class="w-full space-x-4 md:flex md:flex-row">
            <div class="grid-cols-1 space-y-4 md:w-1/2">
                <div class="grid gap-4 md:grid-cols-2">
                    <!-- Total Requests Made Card -->
                    <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                        <a href="{{ route('admin.transport_requests.index') }}">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-600">Total Transport Requests</span>
                                <span class="text-sm font-semibold text-gray-500">Requests made by students</span>
                                <span class="text-3xl font-bold text-fuchsia-600">{{$totalTransportRequests}}</span>
                            </div>
                        </a>
                    </div>
                    <!-- Request Approval Rate -->
                    <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                        <a href="{{ route('admin.transport_requests.index') }}">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-600">Request Approval Rate</span>
                                <span class="text-sm font-semibold text-gray-500">Approved over total</span>
                                <span class="text-3xl font-bold text-fuchsia-600">{{$requestApprovalRate}} %</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <!-- Peak Month Card -->
                    <div class="p-6 bg-white rounded-lg shadow-md hover:bg-gray-50">
                        <a href="{{ route('admin.transport_requests.index') }}">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-600">Peak Month</span>
                                <span class="text-sm font-semibold text-gray-500">Month with most requests</span>
                                <span class="text-3xl font-bold text-fuchsia-600">{{$peakRequestMonth}}</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Trip Status Bars -->
                <div class="p-6 mt-8 bg-white rounded-lg shadow-md hover:bg-gray-50 md:mt-0">
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-600">Trip Status Distribution</span>
                        <span class="text-sm font-semibold text-gray-500">Trip distribution by completion status</span>
                        <x-trip-status-bar />
                    </div>
                </div>
            </div>
            <div class="md:w-1/2">
                <!-- Transport Request Doughnut -->
                <div class="p-6 mt-8 bg-white rounded-lg shadow-md hover:bg-gray-50 md:mt-0">
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-600">Transport Requests Distribution</span>
                        <span class="text-sm font-semibold text-gray-500">Request distribution by approval status</span>
                        <x-transport-request-doughnut />
                    </div>
                </div>
            </div>
        </div>
        <x-admin-section-border />
    </div>

</x-admin-app-layout>

