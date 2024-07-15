<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function show(User $user): View
    {
        if ($user->id != auth()->id()) {
            abort(403, "Próbujesz zobaczyć zakup, którego nie dokonałeś");
        }
        $purchases = Purchase::with('products')->where('user_id', $user->id)->get();
        return view('user.purchases', compact("purchases"));
    }
}
