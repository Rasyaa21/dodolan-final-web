<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ProductUserController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.frontend.store.product.create');
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

            return redirect()->route('store.dashboard', $data['store_id']);
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function show(int $id)
    {
        $product = $this->productRepository->getProductById(request()->route('product'));
        return view('pages.frontend.store.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = $this->productRepository->getProductById(request()->route('product'));
        return view('pages.frontend.store.product.edit', compact('product'));
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

            return redirect()->route('store.dashboard', $request->store_id);
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
