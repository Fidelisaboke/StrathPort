<div class="text-sm leading-3">
    <figure class="relative flex flex-col-reverse p-6 rounded-lg">
        <blockquote class="mt-2 text-slate-700">
            <div class="flex flex-col">
                <p class="text-lg"><span class="text-black">Make: </span>{{$carpoolVehicle->make}}</p>
                <p class="mt-4 text-lg"><span class="text-black">Model: </span>{{$carpoolVehicle->model}}</p>
                <p class="mt-4 text-lg"><span class="text-black">Year: </span>{{$carpoolVehicle->year}}</p>
                <p class="mt-4 text-lg"><span class="text-black">Number Plate: </span>{{$carpoolVehicle->number_plate}}</p>
                <p class="mt-4 text-lg"><span class="text-black">Capacity: </span>{{$carpoolVehicle->capacity}}</p>
            </div>
            <div class="justify-end mt-4 md:items-center md:flex-row md:flex">

                <a href="{{route('carpool_vehicles.edit', $carpoolVehicle->id)}}" class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
                    Edit Vehicle Details
                    <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <form method="post" action="{{ route('carpool_vehicles.destroy', $carpoolVehicle->id) }}">
                    @csrf
                    @method('DELETE')
                    <button @click.prevent="$dispatch('delete', { indexRoute: 'carpool_vehicles.index', id: {{ $carpoolVehicle->id }}, modelClass: 'App\\Models\\CarpoolVehicle'});" type="submit" class="items-center justify-center px-4 py-2 mt-4 font-medium text-center text-white transition ease-in-out delay-150 bg-red-700 rounded-lg md:mt-0 minline-flex text-md hover:-translate-y-1 hover:scale-110 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                        Delete Vehicle
                    </button>
                </form>
            </div>
        </blockquote>
    </figure>
</div>
@livewire('delete-confirmation-modal')
