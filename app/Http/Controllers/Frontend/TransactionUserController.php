<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

use App\Interfaces\TransactionRepositoryInterface;

class TransactionUserController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
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
        //
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = $this->transactionRepository->getTransactionById($id);

        if (!$transaction) {
            Swal::toast('Transaction not found', 'error')->timerProgressBar();
            return redirect()->back();
        }

        return view('pages.frontend.dashboard.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $transaction = $this->transactionRepository->getTransactionById($id);
        return view('pages.frontend.dashboard.transaction.resi', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionDetailRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            $this->transactionRepository->updateTransaction($id, $data);

            Swal::toast('Transaction successfully updated', 'success')->timerProgressBar();

            return redirect()->back();
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
        //
    }
}

