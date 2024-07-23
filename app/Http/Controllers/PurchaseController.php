<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DeliveryMethod;
use App\Models\PurchaseProduct;
use App\Models\PurchaseBySeller;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    private function items()
    {
        $productsInCart = [];
        $totalPrice = 0;
        $delivery_price = 0;
        $priceWithDelivery = 0;
        $deliveryArray = [];
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            foreach ($cart as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];
                $seller_id = $item['seller_id'];
                $delivery = $item['delivery'];

                $productsInCart[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'seller_id' => $seller_id,
                    'delivery' => $delivery
                ];

                $totalPrice += $product->price * $quantity;

                if (!array_key_exists($seller_id, $deliveryArray)) {
                    $deliveryArray[$seller_id] = $delivery->price;
                }
            }
        }

        $delivery_price = array_sum($deliveryArray);

        $priceWithDelivery = $totalPrice + $delivery_price;

        $collection = collect($productsInCart);
        $grouped = $collection->groupBy('seller_id')->sortKeys();
        $deliveryTypes = DeliveryMethod::all();
        return [
            'productsInCart' => $grouped,
            'totalPrice' => $totalPrice,
            'deliveryTypes' => $deliveryTypes,
            'deliveryPrice' => $delivery_price,
            'priceWithDelivery' => $priceWithDelivery,
        ];
    }

    public function create(): View
    {
        $data = $this->items();

        $productsInCart = $data['productsInCart'];
        $totalPrice = $data['totalPrice'];
        $deliveryPrice = $data['deliveryPrice'];
        $priceWithDelivery = $data['priceWithDelivery'];
        $deliveryTypes = $data['deliveryTypes'];

        return view('purchase.create', compact('productsInCart', 'totalPrice', 'deliveryTypes', 'deliveryPrice', 'priceWithDelivery'));
    }

    public function store(): View
    {
        $data = $this->items();
        $productsInCart = $data['productsInCart'];
        $priceWithDelivery = $data['priceWithDelivery'];
        $purchase = Purchase::create(['date' => date('Y-m-d'), 'user_id' => auth()->id(), 'total_price' => $priceWithDelivery]);
        foreach ($productsInCart as $sellerId => $products) {
            $purchaseBySeller = PurchaseBySeller::create(['purchase_id' => $purchase->id, 'seller_id' => $sellerId, 'delivery_status_id' => 1, 'delivery_method_id' => $products[0]['delivery']->id, 'delivered' => false]);
            foreach ($products as $productInCart) {
                PurchaseProduct::create(['purchase_by_seller_id' => $purchaseBySeller->id, 'product_id' => $productInCart['product']->id, 'counter' => $productInCart['quantity']]);
            }
        }
        Session::forget('cart');
        session()->flash('success', ['Zakup został pomyślnie dokonany.']);
        $categories = Category::with('subCategories')->get();
        $randomProducts = Product::with('category')->inRandomOrder()->limit(12)->get();
        return view('welcome', compact('categories', 'randomProducts'));
    }

    public function changeDeliveryMethod(Request $request): View
    {
        $fields = $request->validate([
            'deliveryType' => ['required', 'numeric'],
            'seller_id' => ['required', 'numeric'],
        ]);

        $cart = Session::get('cart');

        $found = false;

        $deliveryType = DeliveryMethod::where('id', '=', $fields['deliveryType'])->first();

        foreach ($cart as $key => $item) {
            if ($item['seller_id'] == $fields['seller_id']) {

                $found = true;

                $cart[$key]['delivery'] = $deliveryType;

                Session::put('cart', $cart);
            }
        }

        if (!$found) {
            session()->flash('error', ["Produkt nie został znaleziony w koszyku."]);
        } else {
            session()->flash('info', ["Rodzaj dostawy został zmieniony."]);
        }

        $data = $this->items();

        $productsInCart = $data['productsInCart'];
        $totalPrice = $data['totalPrice'];
        $deliveryPrice = $data['deliveryPrice'];
        $priceWithDelivery = $data['priceWithDelivery'];
        $deliveryTypes = $data['deliveryTypes'];

        return view('purchase.create', compact('productsInCart', 'totalPrice', 'deliveryTypes', 'deliveryPrice', 'priceWithDelivery'));
    }

    public function index(User $user)
    {
        $role_id = $user->role->id;
        if ($role_id == 1) {
            // TODO: admin view
            return $this->showUserPurchases($user);
        } else if ($role_id == 2) {
            return $this->showSellerPurchases($user);
        } else if ($role_id == 3) {
            return $this->showUserPurchases($user);
        }
    }

    //
    private function showUserPurchases(User $user): View
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


    private function showSellerPurchases(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zakupy, innego użytkownika.");
        }

        $purchasesBySeller = PurchaseBySeller::with([
            'purchase',
            'products.product',
            'delivery_method',
            'delivery_status',
        ])->where('seller_id', $user->id)->where('delivered', '=', false)->get();

        // dd($purchasesBySeller);

        return view('seller.purchases', compact('purchasesBySeller'));
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
