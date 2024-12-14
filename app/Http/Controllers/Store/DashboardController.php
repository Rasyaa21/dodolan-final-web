<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Store::where('username', session('store')->username)->first();

        return view('pages.store.dashboard', compact('store'));
    }
}
