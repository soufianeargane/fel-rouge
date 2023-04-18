<x-dash>
    <h1 class="p-relative">Dashboard</h1>
    <div class="flex justify-center bg-gray-100 py-10 px-4">
        <!---== First Stats Container ====--->
        <div class="container mx-auto pr-1">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">BT SUBSCRIBERS</p>
            </div>
            <div class="flex justify-between px-3 pt-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">20,456</p>
            <!-- <hr > -->
            </div>
        </div>
            <!---== First Stats Container ====--->
        
            <!---== Second Stats Container ====--->
        <div class="container mx-auto pr-1">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-blue-500 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">BT ACTIVE SUBSCRIBERS</p>
            </div>
            <div class="flex justify-between px-3 pt-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">19,694</p>
            <!-- <hr > -->
            </div>
        </div>
            <!---== Second Stats Container ====--->
        
        <!---== Third Stats Container ====--->
        <div class="container mx-auto pr-1">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-purple-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">BT OPT OUTS</p>
            </div>
            <div class="flex justify-between pt-3 px-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">711</p>
            <!-- <hr > -->
            </div>
        </div>
        <!---== Third Stats Container ====--->
        
        <!---== Fourth Stats Container ====--->
        <div class="container mx-auto">
            <div class="w-64 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-16 bg-purple-900 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">BT TODAY'S SUBSCRIPTION</p>
            </div>
            <div class="flex justify-between pt-3 px-3 mb-2 text-sm text-gray-600">
                <p>TOTAL</p>
            </div>
            <p class="pb-4 pt-1 text-3xl ml-5">0</p>
            <!-- <hr > -->
            </div>
        </div>
    <!---== Fourth Stats Container ====--->
    </div>

    <div class="mt-5 flex">
        <div class="w-1/2 p-3">
            <div class=" border">
                <canvas id="userSignupsChart"></canvas>
                <!-- <canvas id=" "></canvas> -->
            </div>
        </div>
        <div class="w-1/2 p-3">
            <table
            class="table-auto border-collapse w-full text-center "
            >
                <thead>
                    <tr>
                        <th>Store Name</th>
                        <th>Owner Name</th>
                        <th>Total Revenue</th>
                        <th>Total Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topStores as $store)
                        <tr>
                            <td>{{ $store->title }}</td>
                            <td>{{ $store->user->name }}</td>
                            <td>{{ $store->orders_sum_total_price }}</td>
                            <td>
                                @if($store->orders_count > 0)
                                    {{ $store->orders_count }}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
            <div class="w-full">
    <!-- BEGIN card -->
    <div class="card border-0 mb-3 bg-gray-800 text-white">
        <!-- BEGIN card-body -->
        <div class="p-4">
            <!-- BEGIN title -->
            <div class="mb-3 text-gray-500 flex items-center">
                <b>TOP PRODUCTS BY UNITS SOLD</b>
                <span class="ml-2">
                    <i class="fa fa-info-circle" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Top products with units sold" data-bs-placement="top" data-bs-content="Products with the most individual units sold. Includes orders from all sales channels."></i>
                </span>
            </div>
            <!-- END title -->
            <!-- BEGIN product -->
            <div class="d-flex items-center mb-4">
                <div class="widget-img rounded-3 me-2 bg-white p-1 w-8 h-8">
                    <div class="h-full w-full" style="background: url(../assets/img/product/product-8.jpg) center no-repeat; background-size: auto 100%;"></div>
                </div>
                <div class="text-truncate flex-grow">
                    <div>Apple iPhone XR (2021)</div>
                    <div class="text-gray-500">$799.00</div>
                </div>
                <div class="ml-auto text-center">
                    <div class="text-sm"><span data-animation="number" data-value="195">0</span></div>
                    <div class="text-gray-500 text-xs">sold</div>
                </div>
            </div>
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



