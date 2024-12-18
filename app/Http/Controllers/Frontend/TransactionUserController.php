<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;
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
            $id = request()->route('transaction');
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
            // Validasi data dari request
            $data = $request->validated();

            $transaction = $this->transactionRepository->updateTransaction($id, $data);

            if (!$transaction) {
                throw new \Exception('Transaction not found');
            }

            $this->sendResiNotification(
                $transaction->receipt_number,
                $transaction->customer_phone,
                $transaction->customer_name
            );

            session()->flash('success', 'Transaction successfully updated');

            return redirect()->back();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());

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

    private function sendResiNotification($resi, $phoneNumber, $customerName)
    {
        $client = new Client();
        $url = 'https://api.fonnte.com/send';

        $message = "Halo $customerName,
    Terima kasih telah berbelanja di toko kami! 😊
    Berikut adalah detail pembelian Anda:
    - Nomor Resi: $resi

    Pesanan Anda sedang kami proses dan akan segera dikirim. Jika ada pertanyaan, jangan ragu untuk menghubungi kami.

    Salam hangat,
    Tim Toko Kami";

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => env('FONNTE_API_KEY'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'target' => $phoneNumber,
                    'message' => $message,
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if (!isset($responseBody['status']) || $responseBody['status'] != 200) {
                throw new \Exception('Failed to send message: ' . ($responseBody['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send notification via Fonnte: ' . $e->getMessage());
            throw new \Exception('An error occurred while sending the message. Please try again.');
        }
    }
}

