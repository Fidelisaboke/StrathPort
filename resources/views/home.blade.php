<!-- component -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-montserrat">
        <!-- Navbar -->
        <header>
            @livewire('home-nav-menu')
        </header>

        <!-- Headline -->
        <section class="flex flex-col items-center bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="flex flex-col items-center mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-white">StrathPort</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Sign up now to take a step towards a smoother, safer, journey!</p>
                    <a href="{{route('register')}}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white transition ease-in-out delay-150 rounded-lg hover:-translate-y-1 hover:scale-125 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
                        Register to begin
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="{{asset('images/school_bus_3d.png')}}" alt="School bus" title="School bus">
                    {{-- <a href='https://pngtree.com/freepng/3d-school-bus-isolated-on-transparent-background-education-concept_7401457.html'>png image from pngtree.com/</a> --}}
                </div>
            </div>
        </section>

        <!-- Benefits -->
        <section class="flex flex-col items-center justify-center py-8 bg-white dark:bg-gray-950">
            <div class="w-4/5 lg:mb-16">
                <h2 class="py-4 mb-4 text-4xl font-extrabold text-center text-gray-900 dark:text-white">Unlock the Future of Transportation</h2>
                <p class="text-center text-gray-500 sm:text-xl dark:text-gray-400">Why should you use StrathPort?</p>
            </div>
            <div class="max-w-screen-xl px-4 py-4 mx-auto sm:pb-16 sm:pt-4 lg:px-6">
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                    <div>
                        <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-100 lg:h-12 lg:w-12 dark:bg-fuchsia-900">
                            <svg class="w-5 h-5 text-fuchsia-600 lg:w-6 lg:h-6 dark:text-fuchsia-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.193-.538 1.193H5.538c-.538 0-.538-.6-.538-1.193 0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365Zm-8.134 5.368a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M8.54 17.901a3.48 3.48 0 0 0 6.92 0H8.54Z"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Real-Time Alerts</h3>
                        <p class="text-gray-500 dark:text-gray-400">On changes or delays in transport schedules</p>
                    </div>
                    <div>
                        <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-100 lg:h-12 lg:w-12 dark:bg-fuchsia-900">
                            <svg class="w-5 h-5 text-fuchsia-600 lg:w-6 lg:h-6 dark:text-fuchsia-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">User-Friendly Interface</h3>
                        <p class="text-gray-500 dark:text-gray-400">For simple navigation throughout the system</p>
                    </div>
                    <div>
                        <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-100 lg:h-12 lg:w-12 dark:bg-fuchsia-900">
                            <svg class="w-5 h-5 text-fuchsia-600 lg:w-6 lg:h-6 dark:text-fuchsia-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">Compliance and Safety</h3>
                        <p class="text-gray-500 dark:text-gray-400">By providing regular updates on availability of vehicles and drivers</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="flex flex-col items-center justify-center py-8 md:flex-row bg-gray-50 dark:bg-gray-900">
            <div class="flex-grow px-8 md:w-1/5 md:flex-col md:items-center md:flex lg:px-12">
                <h2 class="py-4 mb-4 text-4xl font-extrabold text-center text-gray-900 dark:text-white">Features</h2>
                <p class="text-center text-gray-500 sm:text-xl dark:text-gray-400">What does StrathPort offer?</p>
            </div>
            <div class="flex flex-grow md:w-4/5">
                <div class="px-4 py-4 space-y-8 md:grid md:grid-cols-2 lg:px-6 md:gap-12 md:space-y-0">
                    <div class="flex-grow md:items-center md:flex md:flex-col">
                        <div class="flex items-center justify-center w-10 h-10 mb-4 bg-teal-100 rounded-full lg:h-12 lg:w-12 dark:bg-teal-900">
                            <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold md:text-center dark:text-white">Transport Booking</h3>
                        <p class="text-gray-500 md:text-center dark:text-gray-400">To make requests and arrangements for transport</p>
                    </div>
                    <div class="flex-grow md:flex-col md:items-center md:flex">
                        <div class="flex items-center justify-center w-10 h-10 mb-4 bg-teal-100 rounded-full lg:h-12 lg:w-12 dark:bg-teal-900">
                            <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17H16M8 17C8 18.1046 7.10457 19 6 19C4.89543 19 4 18.1046 4 17M8 17C8 15.8954 7.10457 15 6 15C4.89543 15 4 15.8954 4 17M16 17C16 18.1046 16.8954 19 18 19C19.1046 19 20 18.1046 20 17M16 17C16 15.8954 16.8954 15 18 15C19.1046 15 20 15.8954 20 17M10 5V11M4 11L4.33152 9.01088C4.56901 7.58593 4.68776 6.87345 5.0433 6.3388C5.35671 5.8675 5.79705 5.49447 6.31346 5.26281C6.8993 5 7.6216 5 9.06621 5H12.4311C13.3703 5 13.8399 5 14.2662 5.12945C14.6436 5.24406 14.9946 5.43194 15.2993 5.68236C15.6435 5.96523 15.904 6.35597 16.425 7.13744L19 11M4 17H3.6C3.03995 17 2.75992 17 2.54601 16.891C2.35785 16.7951 2.20487 16.6422 2.10899 16.454C2 16.2401 2 15.9601 2 15.4V14.2C2 13.0799 2 12.5198 2.21799 12.092C2.40973 11.7157 2.71569 11.4097 3.09202 11.218C3.51984 11 4.0799 11 5.2 11H17.2C17.9432 11 18.3148 11 18.6257 11.0492C20.3373 11.3203 21.6797 12.6627 21.9508 14.3743C22 14.6852 22 15.0568 22 15.8C22 15.9858 22 16.0787 21.9877 16.1564C21.9199 16.5843 21.5843 16.9199 21.1564 16.9877C21.0787 17 20.9858 17 20.8 17H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold md:text-center dark:text-white">Carpooling Module</h3>
                        <p class="text-gray-500 md:text-center dark:text-gray-400">An alternative to transport booking. Search for and contact available drivers!</p>
                    </div>
                    <div class="md:items-center md:flex-col md:flex">
                        <div class="flex items-center justify-center w-10 h-10 mb-4 bg-teal-100 rounded-full lg:h-12 lg:w-12 dark:bg-teal-900">
                            <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold md:text-center dark:text-white">Transport Schedules</h3>
                        <p class="text-gray-500 md:text-center dark:text-gray-400">Check out school transport schedules on the go</p>
                    </div>
                    <div class="md:items-center md:flex-col md:flex">
                        <div class="flex items-center justify-center w-10 h-10 mb-4 bg-teal-100 rounded-full lg:h-12 lg:w-12 dark:bg-teal-900">
                            <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.209 3.816a1 1 0 0 0-1.966.368l.325 1.74a5.338 5.338 0 0 0-2.8 5.762l.276 1.473.055.296c.258 1.374-.228 2.262-.63 2.998-.285.52-.527.964-.437 1.449.11.586.22 1.173.75 1.074l12.7-2.377c.528-.1.418-.685.308-1.27-.103-.564-.636-1.123-1.195-1.711-.606-.636-1.243-1.306-1.404-2.051-.233-1.085-.275-1.387-.303-1.587-.009-.063-.016-.117-.028-.182a5.338 5.338 0 0 0-5.353-4.39l-.298-1.592Z"/>
                                <path fill-rule="evenodd" d="M6.539 4.278a1 1 0 0 1 .07 1.412c-1.115 1.23-1.705 2.605-1.83 4.26a1 1 0 0 1-1.995-.15c.16-2.099.929-3.893 2.342-5.453a1 1 0 0 1 1.413-.069Z" clip-rule="evenodd"/>
                                <path d="M8.95 19.7c.7.8 1.7 1.3 2.8 1.3 1.6 0 2.9-1.1 3.3-2.5l-6.1 1.2Z"/>
                              </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold md:text-center dark:text-white">Transport Notifications</h3>
                        <p class="text-gray-500 md:text-center dark:text-gray-400">Get notified of updated requests and transport schedules!</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Testimonials -->
        <section class="bg-white dark:bg-gray-950">
            <div class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
                <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">User Testimonials</h2>
                    <p class="mb-4">Thoughts from our users...</p>
                </div>
                <!-- User quotes -->
                <div class="mt-10 space-y-8 md:gap-8 md:grid-cols-3 md:grid md:space-y-0">
                    <div class="flex-grow p-4 border-pink-300 rounded shadow-md bg-pink-50 dark:bg-pink-100 md:flex-col md:flex">
                        <p class="mb-8 text-gray-500 dark:text-gray-800">"User Quote 1"</p>
                        <div class="flex">
                            <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-300 lg:h-12 lg:w-12 dark:bg-fuchsia-400">
                                <svg class="w-5 h-5 text-fuchsia-900 lg:w-6 lg:h-6 dark:text-fuchsia-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h.01M8.99 9H9m12 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM6.6 13a5.5 5.5 0 0 0 10.81 0H6.6Z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col ml-8">
                                <h3 class="mb-2 font-bold dark:text-back">User 1</h3>
                                <p class="text-gray-500 dark:text-gray-700">Student</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow p-4 border-pink-300 rounded shadow-md bg-pink-50 dark:bg-pink-100 md:flex-col md:flex">
                        <p class="mb-8 text-gray-500 dark:text-gray-800">"User Quote 2"</p>
                        <div class="flex">
                            <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-300 lg:h-12 lg:w-12 dark:bg-fuchsia-400">
                                <svg class="w-5 h-5 text-fuchsia-900 lg:w-6 lg:h-6 dark:text-fuchsia-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h.01M8.99 9H9m12 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM6.6 13a5.5 5.5 0 0 0 10.81 0H6.6Z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col ml-8">
                                <h3 class="mb-2 font-bold dark:text-back">User 2</h3>
                                <p class="text-gray-500 dark:text-gray-700">Staff Member</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow p-4 border-pink-300 rounded shadow-md bg-pink-50 dark:bg-pink-100 md:flex-col md:flex">
                        <p class="mb-8 text-gray-800">"User Quote 3"</p>
                        <div class="flex">
                            <div class="flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-fuchsia-300 lg:h-12 lg:w-12 dark:bg-fuchsia-400">
                                <svg class="w-5 h-5 text-fuchsia-900 lg:w-6 lg:h-6 dark:text-fuchsia-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h.01M8.99 9H9m12 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM6.6 13a5.5 5.5 0 0 0 10.81 0H6.6Z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col ml-8">
                                <h3 class="mb-2 font-bold dark:text-back">User 3</h3>
                                <p class="text-gray-500 dark:text-gray-700">Student</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Home page footer -->
        <footer class="p-4 bg-gray-50 sm:p-6 dark:bg-gray-800">
            <div class="max-w-screen-xl mx-auto">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <p class="mb-2 text-gray-400">Template provided by:</p>
                        <a href="https://flowbite.com" class="flex items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Project Info</h2>
                            <ul class="text-gray-600 dark:text-gray-400">
                                <li class="mb-4">
                                    <a href="{{route('about')}}" class="hover:underline">About</a>
                                </li>
                                <li>
                                    <a href="https://github.com/Fidelisaboke/StrathPort" class="hover:underline">GitHub Repo</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Collaborators</h2>
                            <ul class="text-gray-600 dark:text-gray-400">
                                <li class="mb-4">
                                    <a href="https://github.com/Fidelisaboke" class="hover:underline ">Fidel Isaboke</a>
                                </li>
                                <li>
                                    <a href="https://github.com/Lynn-Wahito" class="hover:underline">Lynn Githinji</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Fidel Isaboke and Lynn Githinji</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                        <a href="https://github.com/Fidelisaboke/StrathPort" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
