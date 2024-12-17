<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::with('transactionDetails')->get();
    }

    public function getTransactionById(int $id)
    {
        return Transaction::with('transactionDetails')->find($id);
    }

    public function getTransactionByStoreId(int $id)
    {
        return Transaction::where('store_id', $id)->with('transactionDetails')->get();
    }

    public function createTransaction(array $data)
    {
        $storeId = request()->route('store');
        log::info($data);
        $transactionCode = "TX-" . Str::upper(Str::random(8));


        $transaction = Transaction::create([
            'code' => $transactionCode,
            'store_id' => $storeId,
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_address' => $data['customer_address'],
            'original_price' => $data['original_price'],
            'discount' => $data['discount'],
            'final_price' => $data['final_price'],
            'payment_status' => $data['payment_status'] ?? 'pending',
        ]);

        return $transaction;
    }

    public function updateTransaction(int $id, array $data)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->update([
                'code' => $data['code'],
                'total_price' => $data['total_price'],
                'shipping_fee' => $data['shipping_fee'],
                'original_price' => $data['original_price'],
                'payment_status' => $data['payment_status'],
                'promo_code_id' => $data['promo_code_id'],
                'store_id' => $data['store_id'],
                'final_price' => $data['final_price'],
                'receipt_number' => $data['receipt_number'],
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'customer_address' => $data['customer_address'],
            ]);
        }
        return $transaction;
    }

    public function deleteTransaction(int $id)
    {
        return Transaction::where('id', $id)->delete();
    }

    public function addNoResi(int $id, array $data){
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->update([
                'payment_status' => $data['payment_status'],
                'receipt_number' => $data['receipt_number']
            ]);
        }
    }

    public function checkTransactionCode(string $code): bool{
        return Transaction::where('code', $code)->exists();
    }
}



