<x-store>
    <div class="flex">
        <div>
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
            <div class="order"></div>
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

  // add each product in the order to the UI
  for (var i = 0; i < order.length; i++) {
    var product = order[i];
    var $product = $('<div>').addClass('product');
    var $name = $('<h4>').text(product.name);
    var $price = $('<p>').text(product.price);
    var $quantity = $('<p>').text('Quantity: ' + product.quantity);

    $product.append($name, $price, $quantity);
    $('.order').append($product);
  }
}

</script>