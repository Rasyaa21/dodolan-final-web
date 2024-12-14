<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return view('pages.frontend.landing', compact('stores'));
    }
}
