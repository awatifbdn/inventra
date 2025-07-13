<?php

namespace App\Http\Controllers;
use App\Models\Color;
use App\Models\Litre;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Mail\OrderReceiptCustomer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class OrderController extends Controller
{
 public function addToCart(Request $request)
{
    $colorId = $request->input('color_id');
    $litreId = $request->input('litre_id');
    $quantity = $request->input('quantity', 1); // default to 1 if not provided

    $color = Color::with('product')->findOrFail($colorId);
    $litre = $color->litres->find($litreId);

    $cart = Session::get('cart', []);
    $cart[] = [
        'product' => [
            'id' => $color->product->id,
            'productName' => $color->product->productName,
        ],
        'color' => [
            'id' => $color->id,
            'color_name' => $color->color_name,
            'color_code' => $color->color_code,
            'color_pallet' => $color->color_pallet ?? null,
        ],
        'litre' => [
            'id' => $litre->id,
            'litre' => $litre->litre,
            'price' => $litre->price,
        ],
        'quantity' => (int) $quantity,
    ];

    Session::put('cart', $cart);

    return redirect()->route('order.cart.view')->with('success', 'Item added to cart.');
}


public function selectLitre($colorId)
{
    $color = \App\Models\Color::with('litres', 'product')->findOrFail($colorId);
    
    // ✅ View path matches resources/views/catalog/order/selectLitre.blade.php
    return view('catalog.order.selectLitre', compact('color'));
}

public function showCart()
{
    $cartItems = Session::get('cart', []);
    return view('catalog.order.cart', compact('cartItems'));
}

public function detailCustomer()
{
    $cartItems = Session::get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('catalog.index')->with('error', 'Your cart is empty.');
    }

    return view('catalog.order.details', compact('cartItems'));
}
public function showConfirmation(Request $request)
{
    $cartItems = Session::get('cart', []);
    $customer = $request->only(['name', 'phone', 'email', 'address']);

    if (empty($cartItems)) {
        return redirect()->route('catalog.index')->with('error', 'Your cart is empty.');
    }

    return view('catalog.order.confirmation', compact('cartItems', 'customer'));
}


public function checkout(Request $request)
{
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'phone'   => 'required|string|max:15',
        'email'   => 'required|email',
        'address' => 'required|string|max:500',
    ]);

    $cartItems = Session::get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('catalog.index')->with('error', 'Your cart is empty.');
    }

    $totalPrice = collect($cartItems)->sum(function ($item) {
        return $item['litre']['price'] * ($item['quantity'] ?? 1);
    });

    $orderId = 'FEORD' . now()->format('Ymd') . strtoupper(Str::random(3));

    $order = Order::create([
        'order_id'         => $orderId,
        'customer_name'    => $data['name'],
        'customer_phone'   => $data['phone'],
        'customer_email'   => $data['email'],
        'customer_address' => $data['address'],
        'items'            => $cartItems,
        'total_price'      => $totalPrice,
        'status'           => 'new',
    ]);



    Session::forget('cart');

    return view('catalog.order.success', [
        'order' => $order,
        'cartItems' => $cartItems
    ]);
}


    public function removeItem($index)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            Session::put('cart', array_values($cart)); // Re-index the array
        }
        return redirect()->route('order.cart.view')->with('success', 'Item removed from cart.');
    }
}
