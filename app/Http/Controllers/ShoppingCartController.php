<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function index()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            $productsInCart = [];

            foreach ($cart as $productId => $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];

                $productsInCart[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }

            return view('cart.index', compact('productsInCart'));
        }
        session()->flash('info', ["Twój koszyk jest pusty."]);
        return view('cart.index');
    }

    //
    public function store(Request $request)
    {
        //
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId)->firstOrFail();

        if (!Session::has('cart')) {
            Session::put('cart', []);
        }

        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            session()->flash('warning', ["Produkt jest już w koszyku."]);
            return back();
        }

        $cart[$productId] = [
            'product' => $product,
            'quantity' => $quantity,
        ];

        Session::put('cart', $cart);
        session()->flash('success', ["Dodano przedmiot do koszyka."]);
        return back();
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;

            Session::put('cart', $cart);
            session()->flash('info', ["Ilość produktu została zaktualizowana."]);
            return view('cart.index');
        }
        session()->flash('error', ["Produkt nie został znaleziony w koszyku."]);
        return view('cart.index');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);

            Session::put('cart', $cart);
            session()->flash('success', ["Produkt został usunięty z koszyka."]);
            return view('cart.index');
        }
        session()->flash('error', ['Produkt nie został znaleziony w koszyku.']);
        return view('cart.index');
    }

    public function clearCart()
    {
        Session::forget('cart');
        session()->flash('success', ['Koszyk został wyczyszczony.']);
        return view('cart.index');
    }
}
