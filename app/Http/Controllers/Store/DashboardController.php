<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Repositories\StoreRepository;
use App\Interfaces\StoreRepositoryInterface;

class DashboardController extends Controller
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }
    public function index()
    {
        $store = Store::where('username', session('store')->username)->first();

        return view('pages.store.dashboard', compact('store'));
    }

    public function editColor(){
        $store = $this->storeRepository->getStoreById(session('store')->id);
        return view('pages.store.color', compact('store'));
    }

    public function update(UpdateColorRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $this->storeRepository->updateColor($id, $data);

            Swal::toast('Store color updated successfully', 'success')->timerProgressBar();

            return redirect()->route('store.dashboard', $id);
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
