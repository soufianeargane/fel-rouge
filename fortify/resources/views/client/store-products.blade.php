<x-store>
    <div class="flex">
        <div class="w-2/3 p-3 ">
            <div id="product-list">
                @foreach ($products as $product)
                    <div class="product" data-id="{{ $product->id }}">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->price }}</p>
                        <p>{{ $product->quantity }}</p>
                        <button class="add-to-order p-1 bg-red-200">Add to Order</button>
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
            <div class=""
            style="position: absolute; bottom: 0; left: 50%; transform: translate(-50%);"
            >
                <button id="save-order" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">save</button>
            </div>
        </div>
    </div>
</x-store>
<script>
    var order = [];

// when a product's "add to order" button is clicked
$('.product button').on('click', function() {
  // get the product's ID, name, and price
  var product_id = $(this).closest('.product').data('id');
  var product_name = $(this).closest('.product').find('h4').text();
  var product_price = $(this).closest('.product').find('p').eq(0).text();

  // check if the product is already in the order
  var found = false;
  for (var i = 0; i < order.length; i++) {
    if (order[i].id == product_id) {
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
  }

  console.log(order);
  // update the UI to reflect the new order
  updateOrderUI();
});

// a function to update the UI with the current order
function updateOrderUI() {
  // clear the current order UI
  $('.order').empty();
  var total = 0;

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

//   $.ajax({
//     url: '/orders',
//     method: 'POST',
//     data: {
//       order: order
//     },
//     success: function(response) {
//       console.log(response);
//     }
//   });
});

</script>