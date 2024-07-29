<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opinion;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ReportedOpinion;

class OpinionController extends Controller
{
    //
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                'product_id' => ['required', 'numeric'],
                "stars" => ['required', 'numeric', 'between:1,5'],
                'description' => ['string', 'nullable']
            ]
        );


        $user_id = auth()->user()->id;
        $fields['user_id'] = $user_id;

        Opinion::create($fields);

        return back();
    }

    public function showBySeller()
    {
        $user = User::where("id", auth()->id())->first();
        $role_id = $user->role->id;
        if ($role_id != 2) {
            abort(403, "Tylko sprzedawcy mogą zobaczyć opinie swoich produktów");
        }

        $products = Product::where("seller_id", $user->id)->with('opinions')->paginate(12);

        return view('opinions.seller', compact('products'));
    }

    public function reportOpinion(Opinion $opinion)
    {
        $user = User::where('id', auth()->id())->first();
        $role_id = $user->role->id;
        if ($role_id != 2) {
            abort(403, 'Tylko sprzedawca może zgłaszać opinie');
        }
        // TODO: opinions of products of seller
        ReportedOpinion::create(['opinion_id' => $opinion->id]);

        return back();
    }
}
