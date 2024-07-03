<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title}}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div x-data="{ sidebarOpen: false, notificationOpen: false, dropdownOpen: false, hasNotification: true }" class="flex h-screen bg-gray-200">
            <x-admin-sidebar />
            
            <!-- Main Content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>

                        <div class="relative mx-4 lg:mx-0">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="text-gray-500 fas fa-search"></i>
                            </span>

                            <input class="w-32 py-2 pl-10 pr-4 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg lg:w-64 focus:bg-white focus:border-white focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <button @click="notificationOpen = !notificationOpen" class="relative text-gray-600 focus:outline-none">
                            <i class="text-2xl fas fa-bell"></i>
                            <template x-if="hasNotification">
                                <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-red-600 rounded-full"></span>
                            </template>
                        </button>

                        <!-- Adding margin to separate icons -->
                        <button @click="dropdownOpen = !dropdownOpen" class="relative block w-8 h-8 ml-4 overflow-hidden rounded-full shadow focus:outline-none">
                            <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1591062319230-e859b13c06e8" alt="Your avatar">
                        </button>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">{{$title}}</h3>
                        {{$slot}}
                    </div>
                </main>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
