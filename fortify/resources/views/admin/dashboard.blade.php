<x-dash>
    <h1 class="p-relative">Dashboard</h1>

    <div class="mt-5">
        <div class="w-1/2 p-3">
            <div class=" border">
                <canvas id="userSignupsChart"></canvas>
            </div>
        </div>
        <!-- <canvas id="userStatsChart"></canvas> -->

    </div>
</x-dash>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <!-- <script>
    // Get the chart data from the Laravel controller
    const monthlySignups = @json($monthlySignups);

    // Get the canvas context
    const ctx = document.getElementById('userSignupsChart').getContext('2d');

    // Create the chart
    const chart = new Chart(ctx, {
        type: 'bar', // Change this to 'line' for a line chart
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'User Signups',
                data: monthlySignups,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->

<script>
    // Get the chart data from the Laravel controller
    const monthlySignups = @json($monthlySignups);
    const monthlyOrders = @json($monthlyOrders);

    // Get the canvas context
    const ctx = document.getElementById('userSignupsChart').getContext('2d');

    // Create the chart
    const chart = new Chart(ctx, {
        type: 'bar', // Change this to 'line' for a line chart
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'User Signups',
                    data: monthlySignups,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Orders',
                    data: monthlyOrders,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



