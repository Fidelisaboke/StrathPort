<x-admin-app-layout>
    <x-slot name="title">
        Users
    </x-slot>

    <x-status-message />

    <div class="container grid p-6 mx-auto">
        <!-- General elements -->
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <!-- Add new user -->
            <a href="{{ route('admin.users.create') }}" class="flex justify-between p-4 text-sm font-semibold text-white rounded-lg shadow-md bg-fuchsia-600 hover:bg-fuchsia-700 max-w-max items -center focus:outline-none focus:shadow-outline-blue">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-user-plus"></i>
                    Add New User
                </div>
            </a>
        </div>

        <!-- Search bar -->
        <form action="{{ route('admin.users.search') }}" method="GET">
            <x-search-field />
        </form>

        <!-- Users table in tables folder blade file -->
        <x-tables.table-users-edit :users='$users'/>
    </div>

</x-admin-app-layout>
