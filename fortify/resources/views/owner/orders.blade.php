<x-owner>
    <p>Orders</p>

    <!-- if session has succes -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div>
    <table class="divide-y divide-gray-300 w-full text-center" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Total Price</th>
                    <th>Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td >{{ $order->user->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <div class=" px-2 py-1 rounded font-bold
                            @if($order->status == 0)
                                text-orange-500
                            @elseif($order->status == 1)
                                text-green-800
                            @else
                                text-red-500
                            @endif
                            ">
                            {{
                            $order->status == 0 ? 'Pending' :
                            ($order->status == 1 ? 'Accepted' : 'Rejected')
                        }}
                            </div>

                        </td>
                        <td>
                            <div class="flex gap-1 justify-center">
                                <button data-modal-target="staticModal" data-modal-toggle="staticModal" class=" order-details px-2 py-1 bg-yellow-300 rounded">
                                    View
                                </button>
                                @if($order->status == 0)
                                    <form action="{{route('owner.orders.action')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="px-2 py-1 bg-green-300 rounded">Accept</button>
                                    </form>
                                    <form action="{{route('owner.orders.action')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="px-2 py-1 bg-red-300 rounded">Reject</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- modal -->

<!-- Modal toggle -->


<!-- Main modal -->
<div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Static modal
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div id="modal-body" class="p-6 space-y-6">


            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="staticModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>

</x-owner>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });

        $('.order-details').click(function (e) {
            e.preventDefault();
            var order_id = $(this).closest('tr').find('th').text();
            // console.log(order_id);
            $.ajax({
                type: "GET",
                url: "/owner/orders-details/" + order_id,
                success: function (response) {
                    renderProducts(response);
                }
            });
        });

        function renderProducts(response) {
        // all products and quantity in table
        var products = response.data;
        var html = `
            <table style="width:100%; text-align:center; background-color: red;">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
        `;
        products.forEach(product => {
            html += `
                <tr>
                    <td>${product.name}</td>
                    <td>${product.pivot.quantity}</td>
                </tr>
            `;
        });
        html += `
                </tbody>
            </table>
        `;
        // append to modal body
        $('#modal-body').html(html);

        // Add download button
        var downloadButton = `
            <a href="#" class="btn btn-primary" id="download-pdf-btn">Download PDF</a>
        `;
        $('#modal-body').append(downloadButton);

        // Handle download button click event
        $('#download-pdf-btn').on('click', function() {
            // Get HTML content of table
            var tableHtml = $('#modal-body table').parent().html();

            // URL-encode HTML content
            var urlEncodedHtml = encodeURIComponent(tableHtml);

            // Generate PDF using Laravel controller method
            window.location.href = '/download-pdf?html=' + urlEncodedHtml;
        });
    }
</script>
