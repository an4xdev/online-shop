<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    private function check(string $comm)
    {
        $user = User::where('id', '=', auth()->id())->firstOrFail();
        if ($user->role_id != 1) {
            return abort(403, $comm);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        //
        if (is_null($id)) {
            $categories = Category::get();
            $categoryData = $categories->map(function ($category) {
                return [
                    'label' => $category->name,
                    'value' => $category->id
                ];
            });
            return view('subcategory.create', compact('categoryData'));
        }
        return view('subcategory.create', ['cat_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->check('Tylko administator może dodawać nowe podkategorie.');
        $fields = $request->validate([
            'category_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
        ]);
        Subcategory::create($fields);

        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
        $this->check('Tylko administator może edytować podkategorie.');
        $categories = Category::get();
        $categoryData = $categories->map(function ($category) {
            return [
                'label' => $category->name,
                'value' => $category->id
            ];
        });
        return view('subcategory.edit', compact('categories', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
        $this->check('Tylko administator może edytować podkategorie.');
        $fields = $request->validate([
            'category_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
        ]);
        $subcategory->update($fields);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
        $this->check('Tylko administrator może usuwać podkategorie.');
        $subcategory->delete();
        return redirect()->route('category.index');
    }
}
