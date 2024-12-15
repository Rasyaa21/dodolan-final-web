<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateColorRequest;
use App\Interfaces\ProductRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\StoreRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private StoreRepositoryInterface $storeRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        StoreRepositoryInterface $storeRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
    }

    public function show($username)
    {
        $store = $this->storeRepository->getStoreByUsername($username);

        if (!$store) {
            return redirect()->route('landing');
        }

        return view('pages.frontend.store.show', compact('store'));
    }

    public function product($username, $slug)
    {
        $store = $this->storeRepository->getStoreByUsername($username);
        $product = $this->productRepository->getProductBySlugAndStoreId($slug, $store->id);

        return view('pages.frontend.store.product.show', compact('store', 'product'));
    }

    public function updateColor(UpdateColorRequest $request, int $id)
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
