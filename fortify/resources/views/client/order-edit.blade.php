<x-store>
<div class="flex">
        <div class="w-2/3 p-3 ">
            <div id="product-list">
                @foreach ($products as $product)
                <div class="product" data-id="{{ $product->id }}">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->price }}</p>
                    <p>{{ $product->quantity }}</p>
                    <button {{-- disable if quantity equal t 0 --}} @if ($product->quantity == 0)
                        disabled
                        @endif
                        class="add-to-order p-1 bg-red-200 disabled:bg-green-200">Add to Order</button>
                        <!-- decrease button -->
                        <button class="decrease px-2 py-1 bg-orange-200 disabled:bg-blue-200" disabled>-</button>
                </div>
                @endforeach
            </div>
        </div>
        <div class=" w-1/3 min-h-full bg-gray-100 relative">
            <h3 class="text-center">Order List</h3>
            <div class="order"></div>
            <div>
                <strong>Total Price:</strong>
                <span id="total-price"></span>
                Dhs
            </div>
            <div class="" style="position: absolute; bottom: 0; left: 50%; transform: translate(-50%);">
                <button id="save-order" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">save</button>
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
                var $product = $('<div>').addClass('product');
                var $name = $('<h4>').text(product.name);
                total += product.price * product.quantity;
                var $price = $('<p>').text(product.price);
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
                    console.log(response);
                    // Swal.fire({
                    //     title: 'Success!',
                    //     text: 'Order updated successfully',
                    //     icon: 'success',
                    //     confirmButtonText: 'OK'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         window.location.href = '/orders';
                    //     }
                    // });
                },
                error: function(response) {
                    console.log(response);
                    // Swal.fire({
                    //     title: 'Error!',
                    //     text: 'Something went wrong',
                    //     icon: 'error',
                    //     confirmButtonText: 'OK'
                    // });
                }
            });
        });
    </script>

