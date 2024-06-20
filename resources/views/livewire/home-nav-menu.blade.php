<nav x-data="{ open: false }">
    <!-- Navbar -->
    <div class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">StrathPort</span>
            </a>
            @if(Route::has('login'))
                <!-- Main Navigation Links -->
                <div class="items-center justify-end hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('about') }}" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">About</a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ url('/dashboard') }}" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Dashboard</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                            </li>
                            @if(Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Register</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            @endif
            <!-- Hamburger Menu Button -->
            <div class="flex items-center -me-2 lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 hover:dark:bg-gray-700 focus:dark:bg-gray-700 focus:dark:text-gray-100 hover:dark:text-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <!-- Hamburger Icon -->
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navbar -->
    <div :class="{ 'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1 dark:bg-gray-800">
            @if(Route::has('login'))
                <x-responsive-nav-link class="dark:text-white" href="{{ route('about') }}" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link class="dark:text-white" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="dark:text-white" href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    @if(Route::has('register'))
                        <x-responsive-nav-link class="dark:text-white" href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
