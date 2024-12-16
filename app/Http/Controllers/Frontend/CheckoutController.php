<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        dd($request->cookies->all());
        $cartData = json_decode($request->cookie('checkout_items'), true);
        dd($cartData);
        $checkoutItems = [];
        // foreach($cartData as $item){
        //     $product = Product::find($item['product_id']);
        //     if($product){
        //         $checkoutItems[] = [
        //             'product' => $product,
        //             'qty' => $item['qty'],
        //             'price' => $item['price'],
        //         ];
        //     }
        // }
        $totalPrice = collect($checkoutItems)->sum(function ($item) {
            return $item['qty'] * $item['price'];
        });

        return view('pages.frontend.checkout.index', compact('checkoutItems', 'totalPrice'));
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
