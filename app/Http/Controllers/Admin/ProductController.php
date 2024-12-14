<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\PromoCodesRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ProductController extends Controller
{

    private ProductRepositoryInterface $productRepository;
    private PromoCodesRepositoryInterface $promoRepository;

    public function __construct(ProductRepositoryInterface $productRepository, PromoCodesRepositoryInterface $promoRepository)
    {
        $this->promoRepository  = $promoRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();

            $this->productRepository->createProduct($data);

            Swal::toast('Data Produk Berhasil Ditambahkan', 'success')->timerProgressBar();

            return redirect()->route('admin.store.show', $data['store_id']);
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $codes = $this->promoRepository->getPromoCodeByStoreId($id);
        $product = $this->productRepository->getProductById($id);

        return view('pages.admin.product.show', compact(['product', 'codes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productRepository->getProductById($id);

        return view('pages.admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            $this->productRepository->updateProduct($id, $data);

            Swal::toast('Data Product Berhasil Diubah', 'success')->timerProgressBar();

            return redirect()->route('admin.store.show', $request->store_id);
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->productRepository->deleteProduct($id);

            Swal::toast('Data Produk Berhasil Dihapus', 'success')->timerProgressBar();

            return redirect()->back();
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
