<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Order Accepted</h1>
    <p>Hi {{ $user_name }},</p>
    <p>Your order has been accepted by {{ $store_name }}. the
    total price of your order is {{ $order_total_price }}.
    </p>
    <p>Order ID: {{ $order_id }}</p>
    <p>Thank you for shopping with us.</p>
</body>
</html>
