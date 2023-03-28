<x-owner>
    <p>Orders</p>

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
                            {{
                            $order->status == 0 ? 'Pending' :
                            ($order->status == 1 ? 'Accepted' : 'Rejected')
                        }}

                        </td>
                        <td>
                            <div class="flex gap-1 justify-center">
                                <button class=" order-details px-2 py-1 bg-yellow-300 rounded">
                                    View
                                </button>
                                @if($order->status == 0)
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="px-2 py-1 bg-green-300 rounded">Accept</button>
                                    </form>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="2">
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
                    console.log(response);
                }
            });
        });
    </script>
