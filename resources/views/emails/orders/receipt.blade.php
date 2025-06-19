{{-- resources/views/emails/orders/receipt.blade.php --}}
<h1>Thank you for your order!</h1>

<p>Hello {{ $order->customer_name }},</p>

<p>We’ve received your order and are preparing it for delivery.<br>
Here are the details:</p>

<ul>
@foreach ($order->items as $item)
    <li>
        <strong>{{ $item['product']['productName'] }}</strong> - {{ $item['color']['color_name'] }} ({{ $item['litre']['litre'] }}L)
        <br>
        Price: RM{{ number_format($item['litre']['price'], 2) }}
    </li>
@endforeach
</ul>

<p><strong>Total: RM{{ number_format($order->total_price, 2) }}</strong></p>

<hr>

<p>
    📌 <strong>Please make payment to:</strong><br>
    Account: 1234567890<br>
    Bank: Maybank<br>
    Name: Fitrafham Paints
</p>

<p>
    <a href="{{ url('/catalog') }}" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;border-radius:5px;text-decoration:none;">Back to Catalog</a>
</p>

<p>Thanks again!<br>
<strong>Fitrafham Paints</strong>
</p>