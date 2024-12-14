<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\TransactionRepositoryInterface;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateTransactionRequest;
use App\Interfaces\PromoCodesRepositoryInterface;

class TransactionController extends Controller
{

    private TransactionRepositoryInterface $transactionRepository;
    private PromoCodesRepositoryInterface $promoRepo;

    public function __construct(TransactionRepositoryInterface $transactionRepository, PromoCodesRepositoryInterface $promoRepo)
    {
        $this->transactionRepository = $transactionRepository;
        $this->promoRepo = $promoRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function addNoResi(UpdateTransactionRequest $req, int $id){
        try{
            $data = $req->validated();
            $this->transactionRepository->addNoResi($id, $data);

            Swal::toast('No Resi Berhasil Ditambahkan', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e){
            Swal::toast($e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function view(int $id){
        $transaction = $this->transactionRepository->getTransactionById($id);
        return view('pages.admin.transaction.resi', compact('transaction'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $codes = $this->promoRepo->getAllPromoCodes();
        return view('pages.admin.transaction.create', compact('codes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            $data = $request->validated();
            do {
                $data['code'] = 'TX-' . Str::upper(Str::random(6));
            } while ($this->transactionRepository->checkTransactionCode($data['code']));

            $this->transactionRepository->createTransaction($data);

            Swal::toast('Transaction successfully added', 'success')->timerProgressBar();

            return redirect()->back();
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**q
     * Display the specified resource.
     */
    public function show(int $transactionId)
    {
        $transaction = $this->transactionRepository->getTransactionById($transactionId);

        return view('pages.admin.transaction.resi', compact('transaction'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $transaction = $this->transactionRepository->getTransactionById($id);

        return view('pages.admin.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validated();

            $this->transactionRepository->updateTransaction($id, $data);

            Swal::toast('Transaction successfully updated', 'success')->timerProgressBar();

            return redirect()->route('admin.transaction.index');
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
            $this->transactionRepository->deleteTransaction($id);

            Swal::toast('Transaction successfully deleted', 'success')->timerProgressBar();

            return redirect()->route('admin.transaction.index');
        } catch (\Exception $exception) {
            Swal::toast($exception->getMessage(), 'error')->timerProgressBar();

            return redirect()->back();
        }
    }
}
