<x-owner>
    sooo dashboard
    <div class="w-1/2">
    <canvas id="doughnutChart"></canvas>
    </div>

</x-owner>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('doughnutChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Accepted', 'Rejected'],
                datasets: [{
                    data: [{{ $statusCounts['pending'] }}, {{ $statusCounts['accepted'] }}, {{ $statusCounts['rejected'] }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });

    </script>
