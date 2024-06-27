<div class="flex flex-col items-center p-2 border-black rounded">
    <!--Total Requests Made-->
    <h3 class="text-lg text-center text-gray-800 text-md">Total Requests Made</h3>
    <p class="p-8 text-4xl text-center text-gray-800">{{$transport_requests->count()}}</p>
    <div class="grid grid-cols-3 gap-8 p-4">
        <!-- Pending -->
        <div class="flex flex-col items-center p-4 bg-yellow-600 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Pending</h3>
            <p class="p-4 text-xl text-center text-white lg:text-2xl">{{$pending_count}}</p>
        </div>
        <!-- Approved -->
        <div class="flex flex-col items-center p-4 bg-green-700 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Approved</h3>
            <p class="p-4 text-xl text-center text-white lg:text-2xl">{{$approved_count}}</p>
        </div>
        <!-- Declined -->
        <div class="flex flex-col items-center p-4 bg-red-700 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Declined</h3>
            <p class="p-4 text-xl text-center text-white lg:text-2xl">{{$declined_count}}</p>
        </div>
    </div>
</div>
