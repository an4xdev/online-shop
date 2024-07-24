<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::redirect('/dashboard', '/')->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/purchases/{user}', [PurchaseController::class, 'index'])->name('purchase.user');
    Route::get('/orders/{user}', [PurchaseController::class, 'showOrders'])->name('order.user');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchases', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::put('/purchases', [PurchaseController::class, 'changeDeliveryMethod'])->name('purchase.changeDeliveryMethod');
    Route::put('/purchases/status', [PurchaseController::class, 'editDeliveryStatus'])->name('purchase.changeStatus');
    Route::put('/purchases/complete', [PurchaseController::class, 'completePurchase'])->name('purchase.complete');
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [ShoppingCartController::class, 'store'])->name('cart.store');
    Route::put('/cart', [ShoppingCartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart', [ShoppingCartController::class, 'removeFromCart'])->name('cart.delete');
    Route::delete('/cart/clear', [ShoppingCartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    // Route::resource('product', ProductController::class);
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/category/{sub_category}', [ProductController::class, 'show_by_category'])->name('product.showByCategory');

Route::get('/search', [SearchController::class, 'searchByName'])->name('search.searchByName');
Route::get('/searchByCategory', [SearchController::class, 'searchByNameAndCategory'])->name('search.searchByNameAndCategory');

Route::post('/clear-session-messages', [SessionController::class, 'clearMessages']);


require __DIR__.'/auth.php';
