<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionDetailRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionDetailRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;

use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Interfaces\ProductRepositoryInterface;

class TransactionDetailController extends Controller
{

    private TransactionDetailRepositoryInterface $transactionDetailRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct(TransactionDetailRepositoryInterface $transactionDetailRepository, ProductRepositoryInterface $productRepository)
    {
        $this->transactionDetailRepository = $transactionDetailRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(int $transactionId)
    {
        $details = $this->transactionDetailRepository->getDetailsByTransactionId($transactionId);

        return view('pages.admin.transaction_detail.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        $products = $this->productRepository->getProductByStoreId($id);
        return view('pages.admin.transaction.detail.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionDetailRequest $request)
    {
        try {
            $data = $request->validated();
            $this->transactionDetailRepository->create($data);

            Swal::toast('Transaction detail successfully added', 'success')->timerProgressBar();

            return redirect()->back();
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionDetailRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $this->transactionDetailRepository->update($id, $data);

            Swal::toast('Transaction detail successfully updated', 'success')->timerProgressBar();

            return redirect()->back();
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->transactionDetailRepository->delete($id);

            Swal::toast('Transaction detail successfully deleted', 'success')->timerProgressBar();

            return redirect()->back();
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
