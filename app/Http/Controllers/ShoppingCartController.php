<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{

    public function itemsInCart()
    {
        $productsInCart = [];
        $totalPrice = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            foreach ($cart as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];

                $productsInCart[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];

                $totalPrice += $product->price * $quantity;
            }
        }

        return [
            'productsInCart' => $productsInCart,
            'totalPrice' => $totalPrice,
        ];
    }

    public function index()
    {
        $result = $this->itemsInCart();
        $productsInCart = $result['productsInCart'];
        $totalPrice = $result['totalPrice'];

        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }

    //
    public function store(Request $request)
    {
        //
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::where('id', $productId)->first();

        if (!Session::has('cart')) {
            Session::put('cart', []);
        }

        $cart = Session::get('cart');


        foreach ($cart as $productId => $item) {
            if ($item['product']->id == $productId) {
                session()->flash('warning', ["Produkt jest już w koszyku."]);
                $result = $this->itemsInCart();
                $productsInCart = $result['productsInCart'];
                $totalPrice = $result['totalPrice'];
                return view('cart.index', compact('productsInCart', 'totalPrice'));
            }
        }

        $newProduct = [
            'product' => $product,
            'quantity' => $quantity,
        ];

        $cart[] = $newProduct;

        Session::put('cart', $cart);

        session()->flash('success', ["Dodano przedmiot do koszyka."]);
        $result = $this->itemsInCart();
        $productsInCart = $result['productsInCart'];
        $totalPrice = $result['totalPrice'];
        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = Session::get('cart');

        $found = false;
        $quantity_over_count = false;

        foreach ($cart as $key => $item) {
            if ($item['product']->id == $productId) {

                $found = true;
                if ($item['product']->counter < $quantity) {
                    $quantity_over_count = true;
                    session()->flash('error', ["Zamawiana ilość przekraca stan magazynowy."]);
                    break;
                }

                $cart[$key]['quantity'] = $quantity;

                Session::put('cart', $cart);
                session()->flash('info', ["Ilość produktu została zaktualizowana."]);

                break;
            }
        }

        if (!$found && !$quantity_over_count) {
            session()->flash('error', ["Produkt nie został znaleziony w koszyku."]);
        }

        $result = $this->itemsInCart();
        $productsInCart = $result['productsInCart'];
        $totalPrice = $result['totalPrice'];
        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = Session::get('cart');

        foreach ($cart as $key => $item) {
            if ($item['product']->id == $productId) {
                unset($cart[$key]);

                Session::put('cart', $cart);
                session()->flash('success', ["Produkt został usunięty z koszyka."]);

                $result = $this->itemsInCart();
                $productsInCart = $result['productsInCart'];
                $totalPrice = $result['totalPrice'];
                return view('cart.index', compact('productsInCart', 'totalPrice'));
            }
        }

        session()->flash('error', ['Produkt nie został znaleziony w koszyku.']);
        $result = $this->itemsInCart();
        $productsInCart = $result['productsInCart'];
        $totalPrice = $result['totalPrice'];
        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }

    public function clearCart()
    {
        Session::forget('cart');
        session()->flash('success', ['Koszyk został wyczyszczony.']);
        $result = $this->itemsInCart();
        $productsInCart = $result['productsInCart'];
        $totalPrice = $result['totalPrice'];
        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }
}
