@empty($users)
    <div class="flex items-center justify-center">
        <div class="w-1/2 p-4 mx-auto my-16 text-center bg-white border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700">No users found!</h2>
            <p class="mt-2 text-gray-500">Please add a new user.</p>
        </div>
    </div>
@else
    <x-tables.table-links>
        {{ $users->links() }}
    </x-tables.table-links>
    <div class="mb-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <!-- id -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">ID <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Name -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Name <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Email -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Email <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Roles -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Roles <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Account Status -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Status <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </p>
                        </th>
                        <!-- Actions -->
                        <th class="p-4 transition-colors cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 hover:bg-blue-gray-50">
                            <p class="flex items-center justify-between gap-2 font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Actions
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <!-- ID -->
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$user->id}}</p>
                            </div>
                        </td>
                        <!-- Name -->
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$user->name}}</p>
                            </div>
                            </div>
                        </td>
                        <!-- Email -->
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{$user->email}}</p>
                            </div>
                            </div>
                        </td>
                        <!-- Roles -->
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    @empty($user->getRoleNames())
                                        N/A
                                    @else
                                        @foreach($user->getRoleNames() as $role)
                                            <span class="px-2 py-1 text-xs font-bold text-white rounded-md bg-fuchsia-600">{{$role}}</span>
                                        @endforeach
                                    @endempty
                                </p>
                            </div>
                            </div>
                        </td>
                        <!-- Account Status -->
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                            @if($user->account_status == 'inactive')
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-yellow-600 uppercase rounded-md select-none whitespace-nowrap bg-yellow-500/20" style="opacity: 1;">
                                    <p class="block antialiased leading-none text-center">{{$user->account_status}}</p>
                                </div>
                            @elseif($user->account_status == 'active')
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-600 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20" style="opacity: 1;">
                                    <p class="block antialiased leading-none text-center">{{$user->account_status}}</p>
                                </div>
                            @else
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-red-600 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20" style="opacity: 1;">
                                    <p class="block antialiased leading-none text-center">{{$user->account_status}}</p>
                                </div>
                            @endif
                            </div>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <!-- view -->
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-green-600 rounded hover:text-green-800">View</a>
                            <!-- edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="ml-2 text-indigo-600 rounded hover:text-indigo-800">Edit</a>
                            <!-- delete -->
                            <form class="inline-block" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" x-data>
                                @csrf
                                @method('DELETE')
                                <button @click.prevent="$dispatch('delete', { indexRoute: 'admin.users.index', id: {{ $user->id }}, modelClass: 'App\\Models\\User', adminModule:true });" type="submit" class="ml-2 text-red-600 rounded hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @livewire('delete-confirmation-modal')
        </div>
    </div>
@endempty
