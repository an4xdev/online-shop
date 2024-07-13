<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::resource('product', ProductController::class);
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [SearchController::class, 'searchByName'])->name('search.searchByName');
Route::get('/searchByCategory', [SearchController::class, 'searchByNameAndCategory'])->name('search.searchByNameAndCategory');
require __DIR__.'/auth.php';
