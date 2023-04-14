<x-store>
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

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }
        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            margin: -25px 0 0 -25px;
            border: 5px solid #ccc;
            border-top-color: #333;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <button id="toggleSidebarMobile" class="fixed bottom-4 left-4 z-50 bg-green-800 text-white p-3 rounded-full shadow-md block md:hidden">
        <i class="bi bi-layout-text-sidebar-reverse"></i>
    </button>
    <div id="loader" class="loader hidden">
        <div class="spinner"></div>
    </div>
<div class="flex">
        <div class="w-full md:w-2/3 p-3 pt-12 ">
        <h2 class="text-center">You can edit your order here</h2>
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
                            class="add-to-order px-4 py-2 font-bold text-xl bg-red-200 disabled:bg-red-500 rounded disabled:cursor-not-allowed">+</button>
                            <!-- decrease button -->
                            <button class="decrease px-4 py-2 font-bold text-xl bg-orange-200 disabled:bg-blue-200 disabled:cursor-not-allowed" disabled>-</button>
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
        var order_id = {!! $order_id !!};
        console.log(order_id);
        var old_order = {!! $order !!};
        console.log(old_order);
        var order = [];
        var original_quantities = [];
        // add new_quantity to old order in order array
        for (var i = 0; i < old_order.length; i++) {
            var product = old_order[i];
            var new_product = {
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: product.quantity,
                original_quantity: product.original_qty,
                new_quantity: 0
            };
            order.push(new_product);

    // add original quantity to original_quantities array
            original_quantities[product.id] = product.original_qty;
        }
        var total;

        console.log(original_quantities);
        updateOrderUI();
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
                // if quantity > 0 able of decrease button
                if (product.quantity > 0) {
                    $('.decrease').attr('disabled', false);
                }
            }
            $('#total-price').text(total);
        }

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
                var original_quantity = original_quantities[product_id];
                console.log(original_quantity);
                // if(order[i].original_quantity){
                //     product_quantity = parseInt(product_quantity, 10) + order[i].original_quantity;
                // }
                product_quantity = parseInt(product_quantity, 10) + original_quantity;
                // if quantity = 1 disable the button
                console.log(product_quantity);
                console.log(order[i].quantity);
                if ((order[i].quantity + 1) == (product_quantity)) {
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
                quantity: 1,
                new_quantity: 1
            });

            //able the button of decrease
            $(this).closest('.product').find('.decrease').attr('disabled', false);
        }

        // if quantity = 1 disable the button
        if (product_quantity == 1) {
            // alert('the quantity is not available');
            // disable the button
            $(this).attr('disabled', true);
        }else {
    // able the button of decrease
            $(this).closest('.product').find('.decrease').attr('disabled', false);
        }

        console.log(order);
        // update the UI to reflect the new order
        updateOrderUI();
        });

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
                    // order[i].new_quantity--;
                    if (order[i].quantity  == 0) {
                        order.splice(i, 1);

                        // disable the button of remove from order
                        // $(this).attr('disabled', true);
                        $(this).closest('.product').find('.add-to-order').attr('disabled', true);
                    }else {
                        // able the button of remove from order
                        $(this).closest('.product').find('.add-to-order').attr('disabled', false);
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

        $('#save-order').on('click', function() {
            // check if the order is empty
            if (order.length == 0) {
                alert('Please add at least one product to the order');
                return;
            }
            $('#loader').removeClass('hidden');

            // send the order to the server
            $.ajax({
                url: '/orders/update/' + order_id,
                method: 'POST',
                data: {
                    order: order
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#loader').addClass('hidden');
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/orders';
                        }
                    });
                },
                error: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong',
                        icon: 'error',
                        confirmButtonText: 'OK'
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

