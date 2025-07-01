@extends('layouts.customer')
@section('content')
   <div class="max-w-3xl mx-auto">
        <nav class="text-sm text-gray-500 mb-4">
            <ol class="flex space-x-2">
                <li><a href="/catalog" class="text-blue-600 hover:underline">Main</a></li>
                <li>›</li>
                <li>Payment</li>
            </ol>
        </nav>

        <h2 class="text-2xl font-bold text-green-700 mb-4">✅ Thank You for Your Order!</h2>
        <p class="text-gray-600">We’ve received your order and will process it shortly. A confirmation email has been sent to you.</p>

        <a href="/catalog" class="inline-block mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400">
            Back to Catalog
        </a>
    </div>
@endsection