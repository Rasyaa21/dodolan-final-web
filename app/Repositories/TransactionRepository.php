<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Str;

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
        $transactionCode = "TX-" . Str::upper(Str::random(8));

        $transaction = Transaction::create([
            'code' => $transactionCode,
            'store_id' => request()->route('store'),
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_address' => $data['customer_address'],
            'original_price' => floatval($data['original_price']),
            'discount' => floatval($data['discount']),
            'final_price' => floatval($data['final_price']),
            'payment_status' => $data['payment_status'] ?? 'pending',
            'promo_code_id' => $data['promo_code_id'] ?? null,
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
        $transaction->update([
            'payment_status' => $data['payment_status'],
            'no_resi' => $data['no_resi']
        ]);
    }

    public function checkTransactionCode(string $code): bool{
        return Transaction::where('code', $code)->exists();
    }
}



