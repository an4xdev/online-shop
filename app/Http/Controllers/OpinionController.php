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

    public function showByAdmin()
    {
        $user = User::where("id", auth()->id())->first();
        $role_id = $user->role->id;
        if ($role_id != 1) {
            abort(403, "Tylko administrator może zobaczyć wszystkie opinie o produtkach");
        }
        $products = Product::with('opinions')->paginate(12);
        return view('opinions.admin', compact('products'));
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

    public function showReported()
    {
        $user = User::where('id', auth()->id())->first();
        $role_id = $user->role->id;
        if ($role_id != 1) {
            abort(403, 'Tylko administrator może zobaczyć wszystkie zgłoszone opinie.');
        }

        $reported = ReportedOpinion::with('opinion')->paginate(12);

        return view('opinions.reported', compact('reported'));
    }

    public function reportOpinion(Opinion $opinion)
    {
        $user = User::where('id', auth()->id())->first();
        $role_id = $user->role->id;
        if ($role_id != 2) {
            abort(403, 'Tylko sprzedawca może zgłaszać opinie');
        }

        $products = Product::where('seller_id', '=', auth()->id())->with('opinions')->join('opinions', 'products.id', '=', 'opinions.product_id')->where('opinions.id', '=', $opinion->id)->get();

        if (count($products) == 0) {
            abort(403, 'Sprzedawca może zgłaszać opinie tylko do swoich produktów');
        }

        ReportedOpinion::create(['opinion_id' => $opinion->id]);

        return back();
    }

    public function destroy(ReportedOpinion $opinion)
    {
        $op = Opinion::findOrFail($opinion->opinion->id);
        $op->delete();
        return back();
    }

    public function cancel_report(ReportedOpinion $opinion)
    {
        $opinion->delete();
        return back();
    }
}
