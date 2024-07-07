<div class="p-2 border-black rounded">
    <!--Total Requests Made-->
    <h3 class="text-lg text-center text-gray-800">Total Requests Made</h3>
    <p class="p-4 text-3xl text-center text-gray-800">{{$transportRequestsCount}}</p>
    <div class="grid grid-cols-3 gap-8 p-4">
        <!-- Pending -->
        <div class="flex flex-col items-center p-2 bg-yellow-500 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Pending</h3>
            <p class="p-2 text-xl text-center text-white lg:text-2xl">{{$pendingCount}}</p>
        </div>
        <!-- Approved -->
        <div class="flex flex-col items-center p-2 bg-green-500 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Approved</h3>
            <p class="p-2 text-xl text-center text-white lg:text-2xl">{{$approvedCount}}</p>
        </div>
        <!-- Declined -->
        <div class="flex flex-col items-center p-2 bg-red-500 rounded-lg shadow-xl">
            <h3 class="text-sm text-center text-white lg:text-lg">Declined</h3>
            <p class="p-2 text-xl text-center text-white lg:text-2xl">{{$declinedCount}}</p>
        </div>
    </div>
</div>

<div class="p-2 w-128 h-128">
    <canvas class="items-center" id="transport_request_doughnut"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('transport_request_doughnut').getContext('2d');

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Pending', 'Approved', 'Declined'],
        datasets: [{
          label: 'Transport Request Status',
          backgroundColor: ['rgb(234, 179, 8)', 'rgb(34, 197, 94)', 'rgb(239, 68, 68)'],
          data:  [@json($pendingCount), @json($approvedCount), @json($declinedCount)],
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
</script>
