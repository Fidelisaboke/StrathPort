<div class="flex flex-col text-sm leading-3">
    <figure class="relative flex flex-col-reverse p-6 rounded-lg ">
        <blockquote class="mt-6 text-slate-700">
            <div class="flex flex-col">
                <p><span class="text-black">Email: </span>{{Auth::user()->email}}</p>
                <p class="mt-4"><span class="text-black">Phone No: </span>{{Auth::user()->phone}}</p>
                <p class="mt-4"><span class="text-black">Address: </span>{{Auth::user()->address}}</p>
                @if (Auth::user()->hasRole('carpool_driver'))
                    <p class="mt-4"><span class="text-black">Availability Status: </span>
                        <span>
                            <!-- Load availability status from carpool driver table based on user id -->
                            @php
                                $carpoolDriver = Auth::user()->carpoolDriver;
                            @endphp
                            @if ($carpoolDriver && $carpoolDriver->availability_status == 'Available')
                                <span class="p-2 font-bold text-green-600 rounded-full bg-green-500/20">Available</span>
                            @elseif ($carpoolDriver && $carpoolDriver->availability_status == 'Unavailable')
                                <span class="p-2 font-bold text-red-600 rounded-full bg-red-500/20">Unavailable</span>
                            @endif</span>
                        </p>
                @endif
            </div>
        </blockquote>
        <figcaption class="flex items-center space-x-4">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Current Profile Photo -->
                <div x-show="! photoPreview">
                    <a href="{{route('profile.show')}}">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="object-cover rounded-full h-14 w-14">
                    </a>
                </div>
            </div>
            @endif
            <div class="flex-auto">
                <div class="text-base font-semibold text-slate-90">
                    {{Auth::user()->name}}
                </div>
                <div class="mt-0.5">
                    @if(Auth::user()->hasRole('student'))
                        Student
                    @elseif(Auth::user()->hasRole('staff'))
                        Staff
                    @elseif(Auth::user()->hasRole('carpool_driver'))
                        Carpool Driver
                    @else
                        User
                    @endif
                </div>
            </div>
        </figcaption>
    </figure>
    <div class="flex flex-row items-center justify-end mt-6">
        <a href="{{route('profile.show')}}" class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
            View Profile
            <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </a>
    </div>
</div>
