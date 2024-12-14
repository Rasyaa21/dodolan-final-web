<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function loginStore(Request $request)
    {
        $store = Store::where('username', $request->username)->first();

        if ($store) {
            if (Hash::check($request->password, $store->password)) {
                $request->session()->put('store', $store);
                return redirect()->route('store.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }
}
