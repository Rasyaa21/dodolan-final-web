<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateColorRequest;
use App\Interfaces\ProductRepositoryInterface;
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

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Show the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
/******  b31812a8-d7e9-4523-a3ac-fe63d4948797  *******/
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

        return view('pages.frontend.store.detail', compact('store', 'product'));
    }

    public function store(Request $request){

    }

    public function showDashboard($username){
        $store = $this->storeRepository->getStoreByUsername($username);

        if (!$store) {
            return redirect()->route('landing');
        }

        return view('pages.store.toko', compact('store'));
    }
}
