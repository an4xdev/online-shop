<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        //
        $role_id = $user->role->id;
        if ($role_id == 1) {
            // TODO: admin view
            return $this->showSellerProducts($user);
        } else if ($role_id == 2) {
            return $this->showSellerProducts($user);
        } else if ($role_id == 3) {
            return abort(403, "Użytkownicy nie mogą zobaczyć wszystkich produktów sprzedawcy.");
        }
    }

    private function showSellerProducts(User $user)
    {
        if ($user->id != auth()->id()) {
            return abort(403, "Próbujesz zobaczyć produkty innego sprzedawcy.");
        }
        $products = Product::where("seller_id", "=", $user->id)->paginate(12);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $categoriesData = $categories->map(function ($category) {
            return [
                'label' => $category->name,
                'value' => $category->id,
            ];
        });
        $subCategories = SubCategory::all();
        $subCategoriesData = $subCategories->map(function ($subCategory) {
            return [
                'label' => $subCategory->name,
                'value' => $subCategory->id,
                'category_id' => $subCategory->category_id,
            ];
        });
        return view('product.create', compact('categoriesData', 'subCategoriesData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate(
            [
                'name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'price' => ['required', 'numeric'],
                'image' => ['required', 'image'],
                'counter' => ['required', 'numeric'],
                'sub_category_id' => ['required', 'numeric'],
            ]
        );

        $image_path = $fields['image']->store('uploads', 'public');
        dd($image_path);

        Product::create(
            [
                'name' => $fields['name'],
                'description' => $fields['description'],
                'price' => $fields['price'],
                'image_path' => $image_path,
                'counter' => $fields['counter'],
                'sub_category_id' => $fields['sub_category_id'],
                'seller_id' => auth()->id(),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("product.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function show_by_category(SubCategory $sub_category)
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('category')->where('sub_category_id', "=", $sub_category->id)->get();
        return view('product.show-by-category', compact("products", "categories"));
    }
}
