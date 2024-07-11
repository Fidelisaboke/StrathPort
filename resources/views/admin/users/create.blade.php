<x-admin-app-layout>
    <x-slot name="title">
        Create User
    </x-slot>

    <!-- Back Button -->
    <div class="px-4 py-2 mt-6 rounded max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center text-white">
            <i class="mr-2 fas fa-arrow-left"></i>
            Back to User List
        </a>
    </div>

    @php
        $roles = Spatie\Permission\Models\Role::all();
    @endphp
    <div class="container grid px-6 mx-auto md:w-3/5">
        <div class="items-center p-4 my-6">
            <form method="post" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="overflow-hidden shadow sm:rounded-md">
                    <!-- Name -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('name', '') }}" />
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('email', '') }}" />
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Password -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('password', '') }}" />
                        @error('password')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Secondary Email -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="secondary_email" class="block text-sm font-medium text-gray-700">Secondary email</label>
                        <input type="secondary_email" name="secondary_email" id="secondary_email" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('secondary_email', '') }}" />
                        @error('secondary_email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Address -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="address" name="address" id="address" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('address', '') }}" />
                        @error('address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Phone -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="phone" name="phone" id="phone" type="text" class="block w-full mt-1 rounded-md shadow-sm form-input"
                            value="{{ old('phone', '') }}" />
                        @error('phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Account Status -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="account_status" class="block text-sm font-medium text-gray-700">Account Status</label>
                        <select name="account_status" id="account_status" class="block w-full mt-1 rounded-md shadow-sm form-input">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('account_status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- User Roles -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="roles" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="roles[]" id="roles" class="block w-full mt-1 rounded-md shadow-sm form-input">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-fuchsia-700 hover:bg-fuchsia-800 active:border-fuchsia-500 focus:outline-none focus:border-fuchsia-500 focus:shadow-outline-fuchsia disabled:opacity-25">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-app-layout>
