<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function searchByName(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            return response()->json(['error' => 'Nazwa jest wymagana'], 400);
        }
        $categories = Category::with('subCategories')->get();
        $categoryData = $categories->map(function ($category) {
            return [
                'label' => $category->name,
                'subcategories' => $category->subcategories->map(function ($subcategory) {
                    return [
                        'label' => $subcategory->name,
                        'value' => $subcategory->id
                    ];
                })->toArray()
            ];
        });

        $products = Product::where('name', 'like', "%$search%")->get();
        return view('search.index', compact("products", "categoryData"));
    }

    public function searchByNameAndCategory(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        if (!$search || !$categoryId) {
            return response()->json(['error' => 'Nazwa i podkategoria jest wymagana'], 400);
        }

        $categories = Category::with('subCategories')->get();
        $categoryData = $categories->map(function ($category) {
            return [
                'label' => $category->name,
                'subcategories' => $category->subcategories->map(function ($subcategory) {
                    return [
                        'label' => $subcategory->name,
                        'value' => $subcategory->id
                    ];
                })->toArray()
            ];
        });
        $products = Product::where('name', 'like', "%$search%")
            ->where('sub_category_id', $categoryId)
            ->get();

        return view('search.index', compact("products", "categoryData"));
    }
}
