<x-owner>
    sooo dashboard
    <div class="flex flex-wrap  ">
        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5 mb-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-3 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs"> Orders</h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                        {{$total_orders}}
                    </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-red-500">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class=" mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-4 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Products</h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                        {{$total_products}}
                    </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-pink-500">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Profit</h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                        {{$total_revenue}}
                    </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-lightBlue-500">
                        <i class="fas fa-users"></i>
                    </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Average Rating</h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                        {{
                            $averageRating ?  number_format($averageRating, 1) : 0
                        }} / 5
                    </span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-emerald-500">
                        <i class="fas fa-percent"></i>
                    </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    <div class="flex mt-12 items-center   flex-wrap">
        <div class="w-80  md:w-1/3 mx-auto md:mx-0">

            <canvas id="doughnutChart"></canvas>
        </div>
        <div class="w-full md:w-2/3 px-6 py-3">
            <div class="w-full">
                <!-- BEGIN card -->
                <div class=" bg-gray-800 text-white ">
                    <a href="#">
                        <div class="p-3">
                            <b>COMMENTS: </b>
                        </div>
                        <div>
                            <table class="w-full text-center table-auto">
                                <thead class="w-full text-sm  text-gray-500 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">User</th>
                                        <th scope="col" class="px-6 py-3">Commet</th>
                                        <th scope="col" class="px-6 py-3">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commentsData as $comment)
                                        <tr class=" border-b dark:bg-gray-900 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">{{ $comment['user_name']}}</th>
                                            <td>{{ $comment['comment'] }}</td>
                                            <td>{{ $comment['rating'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </a>

                </div>
            </div>
        </div>
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
                responsive: false,
            }
        });

    </script>
