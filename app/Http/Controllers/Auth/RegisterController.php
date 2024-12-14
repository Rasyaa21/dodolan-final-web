<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Interfaces\StoreRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class RegisterController extends Controller
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(StoreStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $this->storeRepository->createStore($data);

            Swal::toast('Pendaftaran Toko Berhasil, Silahkan Login', 'success')->timerProgressBar();

            return redirect()->route('login');
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
