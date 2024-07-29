<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::redirect('/dashboard', '/')->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // -------------------------- PROFILE -------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -------------------------- PURCHASE ------------------------------------------

    Route::get('/purchases/{user}', [PurchaseController::class, 'index'])->name('purchase.user');
    Route::get('/orders/{user}', [PurchaseController::class, 'showOrders'])->name('order.user');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchases', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::put('/purchases', [PurchaseController::class, 'changeDeliveryMethod'])->name('purchase.changeDeliveryMethod');
    Route::put('/purchases/status', [PurchaseController::class, 'editDeliveryStatus'])->name('purchase.changeStatus');
    Route::put('/purchases/complete', [PurchaseController::class, 'completePurchase'])->name('purchase.complete');

    // -------------------------- SHOPPING CART --------------------------------------

    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [ShoppingCartController::class, 'store'])->name('cart.store');
    Route::put('/cart', [ShoppingCartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart', [ShoppingCartController::class, 'removeFromCart'])->name('cart.delete');
    Route::delete('/cart/clear', [ShoppingCartController::class, 'clearCart'])->name('cart.clear');

    // -------------------------- PRODUCT --------------------------------------------

    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{user}', [ProductController::class, 'index'])->name('product.index');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    // Route::resource('product', ProductController::class);

    // -------------------------- CATEGORY -------------------------------------------

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // -------------------------- SUBCATEGORY ----------------------------------------

    Route::get('/subcategories/create/{id?}', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::get('/subcategories/edit/{subcategory}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::put('/subcategories/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/category/{sub_category}', [ProductController::class, 'show_by_category'])->name('product.showByCategory');

Route::get('/search', [SearchController::class, 'searchByName'])->name('search.searchByName');
Route::get('/searchByCategory', [SearchController::class, 'searchByNameAndCategory'])->name('search.searchByNameAndCategory');

Route::post('/clear-session-messages', [SessionController::class, 'clearMessages']);


require __DIR__.'/auth.php';
