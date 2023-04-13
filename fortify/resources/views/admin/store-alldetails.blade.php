<x-dash>
    Details about
    <span
    class="text-blue-500 font-bold"
    >
    {{ $store->title }}

    </span>
    <div class="flex justify-center py-5 bg-gray-100 2">
        <!---== First Stats Container ====--->
        <div class="container mx-auto pr-2">
            <div class="w-52 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-12 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Products</p>
            </div>
            <div class="flex justify-between items-center px-2 text-sm text-gray-600">
                <p>TOTAL</p> <span class="py-4 text-2xl ml-5">{{$product_count}}</span>
            </div>
            <!-- <hr > -->
            </div>
        </div>
        <div class="container mx-auto pr-2">
            <div class="w-52 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-12 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Orders</p>
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center  text-sm font-medium text-center text-gray-900 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                  </button>
                  <div id="dropdownDots" class="z-10 hidden bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700 dark:divide-gray-600">
                    <div class="flex justify-between items-center px-2 text-sm text-gray-600">
                        <p>Accepted</p> <span class="py-1 text-1xl ml-5">{{$total_orders_accepted}}</span>
                    </div>
                    <div class="flex justify-between items-center px-2 text-sm text-gray-600">
                        <p>Rejected</p> <span class="py-1 text-1xl ml-5">{{$total_orders_rejected}}</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center px-2 text-sm text-gray-600">
                <p>TOTAL</p> <span class="py-4 text-2xl ml-5">{{$total_orders}}</span>
            </div>
            <!-- <hr > -->
            </div>
        </div>
        <div class="container mx-auto pr-2">
            <div class="w-52 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-12 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Profit</p>
            </div>
            <div class="flex justify-between items-center px-2 text-sm text-gray-600">
                <p>TOTAL</p> <span class="py-4 text-2xl ml-5">{{$total_profit}} Dhs</span>
            </div>
            <!-- <hr > -->
            </div>
        </div>
        <div class="container mx-auto pr-2">
            <div class="w-52 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
            <div class="h-12 bg-red-400 flex items-center justify-between">
                <p class="mr-0 text-white text-lg pl-5">Owner</p>
            </div>
            <div class="flex justify-center items-center px-2 text-sm text-gray-600">
                <span class="py-4 text-2xl ml-5">{{$store->user->name}}</span>
            </div>
            <!-- <hr > -->
            </div>
        </div>





    </div>

    {{-- all store orders in table --}}
    <div class="py-5 bg-gray-100 2">
        <div class="container mx-auto pr-2">
            <div class="bg-white mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                <div class="h-12 bg-red-400 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Orders</p>
                </div>
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Customer Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($store->orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$order->id}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$order->user->name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$order->total_price}} Dhs</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($order->status == 0)
                                    bg-yellow-100 text-yellow-800
                                @elseif($order->status == 1)
                                    bg-green-100 text-green-800
                                @elseif($order->status == 2)
                                    bg-red-100 text-red-800
                                @endif
                                ">
                                    @if ($order->status == 0)
                                        Pending
                                    @elseif($order->status == 1)
                                        Accepted
                                    @elseif($order->status == 2)
                                        Rejected
                                    @endif

                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- all products in table --}}

    <div class="py-5 bg-gray-100 2">
        <div class="container mx-auto pr-2">
            <div class="bg-white mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                <div class="h-12 bg-red-400 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Products</p>
                </div>
                <table class="w-full divide-y text-center divide-gray-200">
                    <thead class="bg-gray-50 text-center">
                        <tr>
                            <th width="1%" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                            </th>
                            {{-- image --}}
                            <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product Image
                            </th>
                            <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Name
                            </th>
                            <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Price
                            </th>
                            <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Quantity
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($store->products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->id}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 flex justify-center">
                                        <img src="{{asset('img/products/'.$product->image)}}" alt="" width="60px" height="60px">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->price}} Dhs</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->quantity}}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <script>

    </script>



</x-dash>
