<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\CatalogController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::get('/home', function () {
//  return view('user.home');
//})->name('home');

Route::get('/index', function () {
    return view('catalog.index');
})->name('index');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

// Product routes using resource controller, excluding 'show' since it's not used..
Route::resource('products', ProductController::class)->except(['show']);
Route::put('/products/{product}/update-table', [ProductController::class, 'updateTable'])->name('products.updateTable');




// Inventory routes
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index'); // Main view
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::get('/inventory/history', [InventoryController::class, 'history'])->name('inventory.history');
Route::post('/inventory/update-stock', [InventoryController::class, 'updateStock'])->name('inventory.updateStock');
Route::get('/inventory/search', [InventoryController::class, 'search'])->name('inventory.search');
Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
Route::get('/inventory/live-search', [InventoryController::class, 'liveSearch'])->name('inventory.liveSearch');



// Color routes for a specific product
Route::prefix('products/{product}')->group(function () {
    Route::get('colors', [ColorController::class, 'index'])->name('colors.index');
    Route::post('colors', [ColorController::class, 'store'])->name('colors.store');
    Route::get('colors/{color}/edit', [ColorController::class, 'edit'])->name('colors.edit');
    Route::put('colors/{color}', [ColorController::class, 'update'])->name('colors.update');
    Route::delete('colors/{color}', [ColorController::class, 'destroy'])->name('colors.destroy');
    Route::delete('colors/bulk-delete', [ColorController::class, 'bulkDelete'])->name('colors.bulkDelete');
    Route::post('colors/adjust-price', [ColorController::class, 'adjustPrice'])->name('colors.adjustPrice');
});



//Catalog routes
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');

//Painting tips route
Route::get('/painting-tips', function () {
    return view('catalog.painting-tips');
})->name('painting.tips');

// Order routes
Route::get('/order/{color}', [OrderController::class, 'selectLitre'])->name('order.color');
Route::post('/order/cart', [OrderController::class, 'addToCart'])->name('order.cart');
Route::get('/order/cart/view', [OrderController::class, 'showCart'])->name('order.cart.view');
Route::post('/order/add-to-cart', [OrderController::class, 'addToCart'])->name('order.addToCart');
Route::delete('/order/cart/remove/{index}', [OrderController::class, 'removeItem'])->name('order.cart.remove');
Route::get('/catalog/order/details', [OrderController::class, 'detailCustomer'])->name('order.details');
Route::post('/order/confirmation', [OrderController::class, 'showConfirmation'])->name('order.confirmation');
Route::post('/catalog/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

// Admin routes for orders
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/update', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
    Route::get('/orders/export/csv', [AdminOrderController::class, 'exportCsv'])->name('admin.orders.export.csv');
    Route::get('/orders/export/pdf', [AdminOrderController::class, 'exportPdf'])->name('admin.orders.export.pdf');

});

Route::get('/admin/orders/tab/{tab}', [AdminOrderController::class, 'tab'])->name('admin.orders.tab');


// Let admin display customer and order details
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('orders', AdminOrderController::class)->except(['create', 'edit']);
    Route::get('orders/{order}/receipt', [AdminOrderController::class, 'generateReceipt'])->name('orders.receipt');
});




