<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header img {
            height: 60px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 4px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f0f0f0;
            text-align: left;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ base_path('public/images/logo.png') }}" alt="Company Logo">
        <h1>Order Receipt</h1>
    </div>

    <div class="section">
        <h2>Customer Info</h2>
        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
        <p><strong>Address:</strong> {{ $order->customer_address }}</p>
    </div>

    <div class="section">
        <h2>Order Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size (L)</th>
                    <th>Qty</th>
                    <th>Price (RM)</th>
                    <th>Subtotal (RM)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item['product']['productName'] }}</td>
                        <td>{{ $item['color']['color_name'] }}</td>
                        <td>{{ $item['litre']['litre'] }}</td>
                        <td>{{ $item['quantity'] ?? 1 }}</td>
                        <td>{{ number_format($item['litre']['price'], 2) }}</td>
                        <td>{{ number_format($item['litre']['price'] * ($item['quantity'] ?? 1), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <p class="total">Total: RM{{ number_format($order->total_price, 2) }}</p>
    </div>

    <div class="section">
        <h2>Payment Info</h2>
        <p>Please transfer the amount to:</p>
        <p><strong>Bank:</strong> Maybank</p>
        <p><strong>Account No:</strong> 1234567890</p>
        <p><strong>Recipient:</strong> Fitrafham Paints</p>
    </div>

    <div class="footer">
        Thank you for your order! | Contact: support@fitrafham.com
    </div>

</body>
</html>
