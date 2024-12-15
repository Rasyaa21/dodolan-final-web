<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class CheckoutController extends Controller
{
    public function index()
    {
        // Dummy data for checkout items
        $checkoutItems = [
            [
                'id' => 1,
                'product' => [
                    'name' => 'Product A',
                ],
                'quantity' => 2,
                'price' => 50000,
            ],
            [
                'id' => 2,
                'product' => [
                    'name' => 'Product B',
                ],
                'quantity' => 1,
                'price' => 75000,
            ],
            [
                'id' => 3,
                'product' => [
                    'name' => 'Product C',
                ],
                'quantity' => 3,
                'price' => 30000,
            ],
        ];

        // Calculate total price
        $totalPrice = collect($checkoutItems)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
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
