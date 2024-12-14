<?php

namespace App\Repositories;

use App\Interfaces\TransactionDetailRepositoryInterface;
use App\Models\TransactionDetail;

class TransactionDetailRepository implements TransactionDetailRepositoryInterface
{
    public function getDetailsByTransactionId(int $transactionId)
    {
        return TransactionDetail::where('transaction_id', $transactionId)->get();
    }

    public function create(array $data)
    {
        $detail =  TransactionDetail::create([
            'transaction_id' => $data['transaction_id'],
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'total' => $data['total'],
        ]);
        return $detail;
    }

    public function update(int $id, array $data)
    {
        $detail = TransactionDetail::find($id);

        if ($detail) {
            $detail->update([
                'transaction_id' => $data['transaction_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'total' => $data['total'],
            ]);

            return $detail;
        }
    }

    public function delete(int $id)
    {
        $detail = TransactionDetail::find($id);

        if ($detail) {
            return $detail->delete();
        }

        return false;
    }
}

