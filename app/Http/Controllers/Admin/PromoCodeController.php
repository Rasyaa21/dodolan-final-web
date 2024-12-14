<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\Repositories\PromoCodeRepository;
use Illuminate\Http\Request;
use App\Interfaces\PromoCodesRepositoryInterface;

use RealRashid\SweetAlert\Facades\Alert as Swal;

class PromoCodeController extends Controller
{
    private PromoCodesRepositoryInterface $promoRepo;

    public function __construct(PromoCodesRepositoryInterface $promoRepo)
    {
        $this->promoRepo = $promoRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function getPromoCodeByStoreId(string $store_id)
    {
        $codes = $this->promoRepo->getPromoCodeByStoreId($store_id);
        return view('pages.admin.promocodes.index', compact('codes', 'store_id'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.promocodes.create');
    }

    public function createUser(){
        return view('pages.frontend.store.promocodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromoCodeRequest $request)
    {
        try{
            $data = $request->validated();
            $this->promoRepo->addPromoCode($data);
            Swal::toast('Kode Promo Berhasil Ditambahkan', 'success');
            return redirect()->route('admin.store.show', $request->store_id);
        } catch (\Exception $e){
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $code = $this->promoRepo->getPromoCodeById($id);
        return view('pages.frontend.dashboard.promocodes.edit', compact(['code', 'id']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromoCodeRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $this->promoRepo->updatePromoCode($id, $data);
            Swal::toast('Kode Promo Berhasil Diubah', 'success')->timerProgressBar();
            return redirect()->route('admin.promo.index', $request->store_id);
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }

    }
    public function destroy(string $id)
    {
        try{
            $this->promoRepo->deletePromoCode($id);
            Swal::toast('Data Produk Berhasil Dihapus', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e){
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
