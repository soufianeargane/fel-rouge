<x-dash>
    <h1 class="p-relative p-3">Dashboard</h1>
    <div class="flex justify-between flex-wrap bg-gray-100 py-3 md:py-10 px-0 md:px-4">
        <!---== First Stats Container ====--->
        <div class=" mx-auto  mb-2">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">CLIENTS</p>
            </div>
            <div class="flex justify-between px-3 pt-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">
                {{$clients}}
            </p>
            <!-- <hr > -->
            </div>
        </div>
            <!---== First Stats Container ====--->
        
            <!---== Second Stats Container ====--->
        <div class=" mx-auto  mb-2">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-blue-500 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">STORES</p>
            </div>
            <div class="flex justify-between px-3 pt-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">
                {{$stores}}
            </p>
            <!-- <hr > -->
            </div>
        </div>
            <!---== Second Stats Container ====--->
        
        <!---== Third Stats Container ====--->
        <div class=" mx-auto mb-2">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-purple-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">PROFIT</p>
            </div>
            <div class="flex justify-between pt-3 px-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">
                {{$total_profit}}
            </p>
            <!-- <hr > -->
            </div>
        </div>
        <!---== Third Stats Container ====--->
    <!---== Fourth Stats Container ====--->
    </div>

    <div class="mt-5 flex flex-col md:flex-row">
        <div class="w-80 md:w-1/2 mx-auto md:mx-0 px-0 md:p-3 ">
            <div class=" w-full border">
                <canvas id="userSignupsChart"></canvas>
                <!-- <canvas id=" "></canvas> -->
            </div>
        </div>
        <div class="w-full md:w-1/2  p-3">
            <div>
                <div class="w-full">
                    <!-- BEGIN card -->
                    <div class="card border-0 mb-3 bg-gray-800 text-white">
                        <!-- BEGIN card-body -->
                        <div class="p-4">
                            <!-- BEGIN title -->
                            <div class="mb-3 text-gray-500 flex items-center">
                                <b class="uppercase">Stores with most Profit</b>
                            </div>
                            <!-- END title -->
                            <!-- BEGIN product -->
                            @foreach($topStores as $store)
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-truncate ">
                                    <div>{{ $store->title }}</div>
                                    <div class="text-gray-500">
                                        {{ $store->orders_sum_total_price ? $store->orders_sum_total_price : 0 }}
                                    </div>
                                </div>
                                <div class="text-truncate flex flex-col justify-center items-center">
                                    <div>{{ $store->user->name }}</div>
                                    <div class="text-gray-500">
                                        <span>orders:</span>
                                        {{ $store->orders_count ? $store->orders_count : 0}}
                                        </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- END product -->
                            <!-- Repeating the product template for each product -->
                        </div>
                        <!-- END card-body -->
                    </div>
                     <!-- END card -->
                </div>
            </div>
        </div>
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



