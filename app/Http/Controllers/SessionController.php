<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function clearMessages(Request $request)
    {
        if ($request->input('clear')) {
            session()->forget(['success', 'info', 'warning', 'error']);
        }

        return response()->json(['status' => 'success']);
    }
}
