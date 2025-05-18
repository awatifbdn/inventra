<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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




Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/inventory/update-stock', [InventoryController::class, 'updateStock'])->name('inventory.updateStock');
Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

