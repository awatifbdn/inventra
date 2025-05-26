<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|',
            'phone' => 'required|string|max:20',
        ]);
        return redirect()->route('order now')->with('success', 'Order placed successfully!');
        // Optional: flash a success message and redirect
    }
}
