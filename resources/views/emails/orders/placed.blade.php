<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

@component('mail::message')
# New Order Received

**Customer:** {{ $order->customer_name }}  
**Email:** {{ $order->customer_email }}  
**Address:** {{ $order->customer_address }}

### Order Details:
@foreach ($order->items as $item)
- **Color:** {{ $item['color']['color_name'] }}  
- **Size:** {{ $item['litre']['litre'] }}L - RM{{ $item['litre']['price'] }}
@endforeach

**Total:** RM{{ $order->total_price }}

@component('mail::button', ['url' => url('/admin/orders')])
View in Admin Panel
@endcomponent

Thanks,  
Fitrafham Paints
@endcomponent
