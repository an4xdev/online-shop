<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private function check(string $comm)
    {
        $role_id = User::where('id', '=', auth()->id())->get();
        if ($role_id != 1) {
            return abort(403, $comm);
        }
    }

    //
    public function index()
    {
        $this->check('Tylko administator może zobaczyć wszystkie kategorie.');
        $categories = Category::with('subcategories')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $this->check('Tylko administator może dodawać nowe kategorie.');
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->check('Tylko administator może dodawać nowe kategorie.');
        $fields = $request->validate([
            'name' => ['required', 'string'],
        ]);
        Category::create($fields);

        return $this->index();
    }

    public function edit(Category $category)
    {
        $this->check('Tylko administator może edytować kategorie.');
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->check('Tylko administator może edytować kategorie.');
        $fields = $request->validate([
            'name' => ['required', 'string'],
        ]);
        $category->update($fields);
        return $this->index();
    }

    public function destroy(Category $category)
    {
        $this->check('Tylko administrator może usuwać kategorie.');
        $category->delete();
        return $this->index();
    }
}
