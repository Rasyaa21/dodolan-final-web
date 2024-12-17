<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'code' => 'TRX001',
                'store_id' => 1,
                'customer_name' => 'John Doe',
                'customer_phone' => '123456789',
                'customer_address' => '123 Main St, Springfield',
                'original_price' => 500000,
                'discount' => 50000,
                'final_price' => 450000,
                'payment_status' => 'paid',
            ],
        ];

        foreach ($transactions as $transactionData) {
            $transaction = Transaction::create($transactionData);

            for ($i = 1; $i <= 3; $i++) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $i,
                    'qty' => rand(1, 5),
                    'price' => 100000,
                ]);
            }
        }
    }
}
