<!DOCTYPE html>
<html>
<head>
    <title>New Order Details</title>
</head>
<body>
<h1>New Order Details</h1>
<p>Thank you for your order! Here are the details:</p>

<table>
    <tr>
        <th>Order ID</th>
        <td>{{ $order->id }}</td>
    </tr>
    <tr>
        <th>Foreign Currency</th>
        <td>{{ $order->foreign_currency }}</td>
    </tr>
    <tr>
        <th>Exchange Rate</th>
        <td>{{ $order->exchange_rate }}</td>
    </tr>
    <tr>
        <th>Surcharge Amount</th>
        <td>{{ $order->surcharge_amount }}</td>
    </tr>
    <!-- Add more order details here as needed -->
</table>

<p>If you have any questions or concerns, please contact our support team.</p>
<p>Thank you for choosing our service!</p>
</body>
</html>
