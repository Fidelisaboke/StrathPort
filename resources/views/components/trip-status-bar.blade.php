,<div class="p-2 w-128 h-128">
    <canvas class="items-center" id="trip_status_bar"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('trip_status_bar').getContext('2d');

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
