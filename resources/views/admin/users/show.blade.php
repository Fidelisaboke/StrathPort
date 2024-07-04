<!-- Show user details -->
<x-admin-app-layout>
    <x-slot name="title">
        User Details
    </x-slot>

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to User List
        </a>
    </div>

    <div class="container grid w-3/5 px-6 mx-auto">
        <div class="items-center p-4 my-6">
            <div class="overflow-hidden shadow sm:rounded-md">
                <!-- Name -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="flex justify-between">
                        <span>{{ $user->name }}</span>
                    </div>
                </div>
                <!-- Email -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="flex justify-between">
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
                <!-- Secondary Email -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="secondary_email" class="block text-sm font-medium text-gray-700">Secondary email</label>
                    <div class="flex justify-between">
                        <span>{{ $user->secondary_email }}</span>
                    </div>
                </div>
                <!-- Address -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <div class="flex justify-between">
                        <span>{{ $user->address }}</span>
                    </div>
                </div>
                <!-- Phone -->
                <div class="px-4 py-2 bg-white border-b sm:p-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <div class="flex justify-between">
                        <span>{{ $user->phone }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
