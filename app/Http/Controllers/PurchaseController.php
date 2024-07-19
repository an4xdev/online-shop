<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    private function items()
    {
        $productsInCart = [];
        $delivery = null;
        $totalPrice = 0;
        $priceWithDelivery = 0;
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

            if (Session::has('delivery')) {
                $delivery = Session::get('delivery');
                $priceWithDelivery = $totalPrice + $delivery['price'];
            } else {
                $delivery = [
                    'id' => 1,
                    'price' => 0,
                ];
                Session::put('delivery', $delivery);
            }

        }
        $deliveryTypes = DeliveryMethod::all();
        return [
            'productsInCart' => $productsInCart,
            'totalPrice' => $totalPrice,
            'priceWithDelivery' => $priceWithDelivery,
            'deliveryTypes' => $deliveryTypes,
            'delivery' => $delivery
        ];
    }

    public function create(): View
    {
        $data = $this->items();

        $productsInCart = $data['productsInCart'];
        $totalPrice = $data['totalPrice'];
        $priceWithDelivery = $data['priceWithDelivery'];
        $deliveryTypes = $data['deliveryTypes'];
        $delivery = $data['delivery'];

        return view('purchase.create', compact('productsInCart', 'totalPrice', 'priceWithDelivery', 'deliveryTypes', 'delivery'));
    }

    public function changeDeliveryMethod(Request $request)
    {
        $fields = $request->validate([
            'deliveryType' => ['required', 'numeric']
        ]);
        if (Session::has('delivery')) {
            $delivery = Session::get('delivery');

            $methods = DeliveryMethod::findOrFail($fields['deliveryType']);

            $delivery = [
                'id' => $methods->id,
                'price' => $methods->price,
            ];
            Session::put('delivery', $delivery);
        } else {
            $delivery = [
                'id' => 1,
                'price' => 0,
            ];
            Session::put('delivery', $delivery);
        }

        $data = $this->items();

        $productsInCart = $data['productsInCart'];
        $totalPrice = $data['totalPrice'];
        $priceWithDelivery = $data['priceWithDelivery'];
        $deliveryTypes = $data['deliveryTypes'];
        $delivery = $data['delivery'];

        return view('purchase.create', compact('productsInCart', 'totalPrice', 'priceWithDelivery', 'deliveryTypes', 'delivery'));
    }

    //
    public function showPurchases(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zakupy, innego użytkownika.");
        }

        $purchases = Purchase::where('user_id', $user->id)
            ->whereHas('bySellers', function ($query) {
                $query->where('delivery_status_id', 4);
            })
            ->with([
                'bySellers' => function ($query) {
                    $query->where('delivery_status_id', 4)
                        ->with('products.product');
                }
            ])
            ->get();

        // dd($purchases);

        return view('user.purchases', compact("purchases"));
    }

    public function showOrders(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zamówienie innego użytkownika.");
        }


        $orders = Purchase::where('user_id', $user->id)
            ->whereHas('bySellers', function ($query) {
                $query->where('delivery_status_id', '!=', 4);
            })
            ->with([
                'bySellers' => function ($query) {
                    $query->where('delivery_status_id', '!=', 4)
                        ->with('products.product');
                }
            ])
            ->get();

        // dd($orders);
        return view('user.orders', compact("orders"));
    }
}
