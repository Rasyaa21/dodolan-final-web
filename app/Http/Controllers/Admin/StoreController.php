<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\PromoCodesRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

use RealRashid\SweetAlert\Facades\Alert as Swal;

class StoreController extends Controller
{

    private StoreRepositoryInterface $storeRepository;
    private PromoCodesRepositoryInterface $promoRepo;
    private TransactionRepositoryInterface $transactionRepo;


    public function __construct(StoreRepositoryInterface $storeRepository, PromoCodesRepositoryInterface $promoRepo, TransactionRepositoryInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->promoRepo = $promoRepo;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeRepository->getAllStores();

        return view('pages.admin.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $this->storeRepository->createStore($data);

            Swal::toast('Data Toko Berhasil Ditambahkan', 'success')->timerProgressBar();

            return redirect()->route('admin.store.index');
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $codes = $this->promoRepo->getPromoCodeByStoreId($id);
        $store = $this->storeRepository->getStoreById($id);
        $transactions = $this->transactionRepo->getTransactionByStoreId($id);

        return view('pages.admin.store.show', compact(['store', 'codes', 'transactions']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store = $this->storeRepository->getStoreById($id);

        return view('pages.admin.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, string $id)
    {
        try{
            $data = $request->validated();
            $this->storeRepository->updateStore($id, $data);

            Swal::toast('Data Toko Berhasil Diubah', 'success')->timerProgressBar();
            return redirect()->route('admin.store.index');
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->storeRepository->deleteStore($id);

            Swal::toast('Data Toko Berhasil Dihapus', 'success')->timerProgressBar();

            return redirect()->route('admin.store.index');
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
