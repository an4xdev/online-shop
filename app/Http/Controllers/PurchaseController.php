<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function showPurchases(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zakup, którego nie dokonałeś.");
        }
        $purchases = Purchase::with('products')->where('user_id', $user->id)->with('delivery')->where('delivery_id', 4)->get();
        return view('user.purchases', compact("purchases"));
    }

    public function showOrders(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zamówienie, którego nie dokonałeś.");
        }

        $orders = Purchase::with('products')->with('delivery')->where('user_id', $user->id)->where('delivery_id', "!=", 4)->get();
        return view('user.orders', compact("orders"));
    }
}
