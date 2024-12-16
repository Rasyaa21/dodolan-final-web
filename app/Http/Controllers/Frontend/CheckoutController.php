<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.frontend.checkout.index');
    }

    public function process(Request $request)
    {
        // Dummy response for checkout success
        return redirect()->route('checkout.success')->with('success', 'Checkout successful');
    }

    public function success()
    {
        return view('pages.frontend.checkout.success');
    }
}
