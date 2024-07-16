<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    public function create(): View
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
        return view('cart.index', compact('productsInCart', 'totalPrice'));
    }
    //
    public function showPurchases(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zakup, którego nie dokonałeś.");
        }
        $purchases = Purchase::with('products')->where('user_id', $user->id)->where('delivery_status_id', 4)->get();
        return view('user.purchases', compact("purchases"));
    }

    public function showOrders(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zamówienie, którego nie dokonałeś.");
        }

        $orders = Purchase::with('products')->with('delivery_status')->where('user_id', $user->id)->where('delivery_status_id', "!=", 4)->get();

        return view('user.orders', compact("orders"));
    }
}
