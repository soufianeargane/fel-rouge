<x-store>
    {{-- store id --}}
    <style>
        .sidebar-open {
            z-index: 1000; /* Set a high value to make the sidebar appear above other elements */
            position: fixed; /* Make the sidebar fixed so it's always visible */
            right: 0;
            top: 0;
            bottom: 0;
            display: flex;
            width: 300px; /* Set the width of the sidebar */
            overflow-y: auto; /* Add a scrollbar if the content overflows the viewport */
        }

        .save-btn{
            padding: 6px 40px;
            border-radius: 30px;
            border: none;
            outline: none;
            background-color: #7cbda0;
            color: #f0faf9;
            font-size: 20px;
            cursor: pointer;
        }
        .save-btn:hover{
            background-color: #549450;
            color: #000;
        }
    </style>

    <button id="toggleSidebarMobile" class="fixed bottom-4 left-4 z-50 bg-green-800 text-white p-3 rounded-full shadow-md block md:hidden">
            <i class="bi bi-layout-text-sidebar-reverse"></i>
        </button>
    <div class="flex">
        <div class="w-full md:w-2/3 p-3 pt-12 ">
            <h2 class="text-center">You can add any available product to the list</h2>
            <div id="product-list" class="flex flex-wrap gap-2 p-2">
                @foreach ($products as $product)
                <div class="product border-2 p-2 bg-white rounded-md mx-auto sm:mx-0" data-id="{{ $product->id }}">
                    <div>
                        <img src="{{ asset('img/products/'.$product->image) }}" alt="" class="w-full h-32 object-cover">
                    </div>
                    <span>
                        <h4>{{ $product->name }}</h4>
                    </span>
                    <div class="flex items-center">
                        <span class="text-xs mr-1" >price:</span>
                        <p class="text-sm font-bold">{{ $product->price }}</p>
                    </div>
                    <div class="flex items-center hidden">
                        <span class="text-xs mr-1">Quantity:</span>
                        <p class="text-sm font-bold">{{ $product->quantity }}</p>
                    </div>
                    <div class="flex justify-center gap-3 pt-2">
                        <button
                        @if ($product->quantity == 0)
                        disabled
                        @endif
                        class="add-to-order px-2 py-1 bg-red-200 disabled:bg-green-200 rounded">+</button>
                        <!-- decrease button -->
                        <button class="decrease px-2 py-1 bg-orange-200 disabled:bg-blue-200" disabled>-</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div style="min-height: calc(100vh - 40px)" class=" sidebar-mobile w-1/3 py-4 px-3  bg-gray-100 flex flex-col justify-between hidden md:flex">
            <div>
                <h3 class="text-center mb-5">Order List</h3>
                <div class="order"></div>
            </div>
            <div>
                <div class="flex justify-between items-center">
                    <div>
                        <strong>
                            Total Price:
                        </strong>
                        <span id="total-price"></span>
                        Dhs
                    </div>

                    <div class="" style="">
                    <button id="save-order" type="button" class=" save-btn">save</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-store>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    var order = [];
    var total;
    // when a product's "add to order" button is clicked
    $('.add-to-order').on('click', function() {
        // get the product's ID, name, and price
        var product_id = $(this).closest('.product').data('id');
        var product_name = $(this).closest('.product').find('h4').text();
        var product_price = $(this).closest('.product').find('p').eq(0).text();
        var product_quantity = $(this).closest('.product').find('p').eq(1).text();

        // check if the product is already in the order
        var found = false;
        for (var i = 0; i < order.length; i++) {
            if (order[i].id == product_id) {
                // if quantity = 1 disable the button
                if ((order[i].quantity + 1) == (product_quantity - 0)) {
                    // alert('the quantity is not available');
                    // disable the button
                    $(this).attr('disabled', true);
                }
                order[i].quantity++;
                found = true;
                break;
            }
        }

        // if the product is not in the order, add it with a quantity of 1
        if (!found) {
            order.push({
                id: product_id,
                name: product_name,
                price: parseFloat(product_price),
                quantity: 1
            });

            //able the button of decrease
            $(this).closest('.product').find('.decrease').attr('disabled', false);
        }

        // if quantity = 1 disable the button
        if (product_quantity == 1) {
            // alert('the quantity is not available');
            // disable the button
            $(this).attr('disabled', true);
        }

        console.log(order);
        // update the UI to reflect the new order
        updateOrderUI();
    });


    // when a product's "decrease" button is clicked
    $('.decrease').on('click', function() {
        // get the product's ID, name, and price
        var product_id = $(this).closest('.product').data('id');
        var product_quantity = $(this).closest('.product').find('p').eq(1).text();

        // check if the product is already in the order
        var found = false;
        for (var i = 0; i < order.length; i++) {
            if (order[i].id == product_id) {
                // if quantity = 1 disable the button
                order[i].quantity--;
                if (order[i].quantity  == 0) {
                    // disable the button
                    $(this).attr('disabled', true);

                    // remove the product from the order
                    order.splice(i, 1);
                }
                // able the button of add to order
                $(this).closest('.product').find('.add-to-order').attr('disabled', false);
                break;
            }
        }


        console.log(order);
        // update the UI to reflect the new order
        updateOrderUI();
    });

    // a function to update the UI with the current order
    function updateOrderUI() {
        // clear the current order UI
        $('.order').empty();
        total = 0;
        // add each product in the order to the UI
        for (var i = 0; i < order.length; i++) {
            var product = order[i];
            var $product = $('<div>').addClass('product px-2 py-1 mb-2 product-item flex justify-between items-center bg-gray-200 rounded text-sm');
            var $name = $('<h4>').text(product.name);
            total += product.price * product.quantity;
            var $price = $('<p>').text('Price: ' + product.price);
            var $quantity = $('<p>').text('Quantity: ' + product.quantity);

            $product.append($name, $price, $quantity);
            $('.order').append($product);
        }
        //   var $total = $('<p>').text('Total: ' + total);
        //     $('.order').append($total);
        // show the total price in element with id "total-price"
        $('#total-price').text(total);
    }

    // when the "save" button is clicked
    $('#save-order').on('click', function() {
        // check if the order is empty
        if (order.length == 0) {
            alert('Please add some products to the order');
            return;
        }
        console.log("siiiiii");
        // send the order to the server

        $.ajax({
            url: '/store/orders',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order: order,
                store_id: {{$store->id}},
                total_price: total
            },
            success: function(response) {
                console.log(response);
                // clear the order
                order = [];
                // update the UI to reflect the new order
                updateOrderUI();
                Swal.fire({
    icon: 'success',
    title: 'Order has been made successfully',
    text: 'You will be redirected to the orders page',
  confirmButtonText: "okay",
  showCancelButton: false,
  });
            }
        });
    });



    $(document).ready(function() {
        $('#toggleSidebarMobile').on('click', function() {
            const sidebar = $('div.sidebar-mobile');
            sidebar.toggleClass('sidebar-open');
        });
    });


    $(document).ready(function() {
    // Define the media query
        const mediaQuery = window.matchMedia("(max-width: 767px)");

        // Run the function once on page load
        checkScreenSize(mediaQuery);

        // Add an event listener to listen for changes in screen size
        mediaQuery.addListener(checkScreenSize);

        function checkScreenSize(e) {
            if (e.matches) {
                console.log('mobile');
            } else {
                //remove the class
                const sidebar = $('div.sidebar-mobile');
                sidebar.removeClass('sidebar-open');
                console.log('desktop');
            }
        }
    });


</script>
