<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;

class CheckoutController extends Controller
{
    public function index()
    {
        $storeId = request()->route('store');
        $store = Store::find($storeId);
        return view('pages.frontend.checkout.index', compact('store'));
    }

    public function process(Request $request)
    {
        // Dummy response for checkout success
        return redirect()->route('pages.frontend.checkout.success')->with('success', 'Checkout successful (Dummy Data)!');
    }

    public function success()
    {
        return view('pages.frontend.checkout.success');
    }
}
