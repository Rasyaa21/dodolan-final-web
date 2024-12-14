<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\StoreStoreRequest;
use App\Interfaces\StoreRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function registerIndex(){
        return view('pages.frontend.auth.register');
    }

    public function loginIndex(){
        return view('pages.frontend.auth.login');
    }

    public function register(SignInRequest $request)
    {
        try{
            $data = $request->validated();
            $data['logo'] = isset($data['logo']) ? $data['logo']->store('assets/store', 'public') : null;
            $data['city'] = $data['city'] ?? null;
            $username = Store::where('username', $data['username'])->first();
            if (!$username){
                Log::info('Data yang diterima:', $data);
                $store = $this->storeRepository->createStore($data);
                Log::info('Store berhasil dibuat:', $store->toArray());
                $token = $store->createToken('dodolan');
                return view('pages.frontend.dashboard.index', compact('store', 'token'));
            }
            return redirect()->route('register')->withErrors(['username' => 'Username already exists.']);
        } catch (\Exception $e){
            return redirect()->route('register')->withErrors(['error' => $e->getMessage()]);
        }
    }
}

