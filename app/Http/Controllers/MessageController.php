<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\PurchaseBySeller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function showByPurchase(PurchaseBySeller $purchase_by_seller)
    {
        $purchase_by_seller = PurchaseBySeller::with(['messages.user'])->find($purchase_by_seller->id);
        // dd($purchase_by_seller);
        return view('messages.show', compact('purchase_by_seller'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                'purchase_by_seller_id' => ['required', 'numeric'],
                'text' => ['required', 'string'],
            ]
        );
        $fields['sender_id'] = auth()->id();

        Message::create($fields);

        return back();
    }
}
