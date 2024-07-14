<div class="p-4 mb-8 bg-white rounded-lg shadow-xl">
    <h2 class="text-lg font-semibold text-gray-800">Carpool Trips History</h2>
    <div class="p-2 w-128 h-128">
        <canvas class="items-center" id="carpool_trip_status_bar"></canvas>
    </div>
    <!-- View All Trips Button -->
    <div class="flex flex-row items-center justify-end mt-2">
        <a href="{{ route('driver.carpooling_details.index') }}"
            class="inline-flex items-center justify-center px-4 py-2 mr-3 font-medium text-center text-white transition ease-in-out delay-150 rounded-lg text-md hover:-translate-y-1 hover:scale-110 bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:ring-pink-300 dark:focus:ring-fuchsia-900">
            View All Trips
            <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('carpool_trip_status_bar').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['In Progress', 'Completed', 'Cancelled'],
        datasets: [{
          label: 'Trip Status',
          data:  [@json($inProgressCount), @json($completedCount), @json($cancelledCount)],
          backgroundColor: ['rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
          borderColor: ['rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
</script>
