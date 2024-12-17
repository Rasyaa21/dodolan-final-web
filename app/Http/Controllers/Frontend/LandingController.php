<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request){
        $stores = Store::all();

        return view('pages.frontend.landing', compact('stores'));
    }
    public function listToko(Request $request){
        $query = $request->input('product_name');
        $products = Product::when($query, function ($q) use ($query){
            $q->where('name', 'like', '%' . $query . '%');
        })->get();
        return view('pages.frontend.store', compact('products'));
    }

    public function about(){
        return view('pages.frontend.about');
    }
}
