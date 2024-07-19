<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('subCategories')->get();
        $randomProducts = Product::with('category')->inRandomOrder()->limit(12)->get();
        return view('welcome', compact('categories', 'randomProducts'));
    }
}
