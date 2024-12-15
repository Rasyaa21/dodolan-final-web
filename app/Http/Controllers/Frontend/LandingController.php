<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request){
        $stores = Store::all();

        return view('pages.frontend.landing', compact('stores'));
    }

    public function listToko(){
        $stores = Store::all();

        return view('pages.frontend.store', compact('stores'));
    }

    public function about(){
        return view('pages.frontend.about');
    }
}
