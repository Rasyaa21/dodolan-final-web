<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $server_key = config('midtrans.server_key');
        $shashed_key = hash('sha256', $request->order_id . $request->status_code . $request->gross_amount . $server_key);

        if ($shashed_key !== $request->signature_key) {
            return response() -> json(['message' => 'Invalid signature key'], 400);
        }

        $transactionstatus = $request->payment_status;
        $orderId = $request->code;
        $transaction = Transaction::where('code', $orderId)->first();

        if( !$transaction){
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        switch ($transactionstatus) {
            case 'settlement':
                $transaction->update([
                    'payment_status' => 'paid',
                ]);
                break;
            case 'pending':
                $transaction->update([
                    'payment_status' => 'pending',
                ]);
                break;
            case 'deny':
                $transaction->update([
                    'payment_status' => 'failed',
                ]);
                break;
            case 'expire':
                $transaction->update([
                    'payment_status' => 'failed',
                ]);
                break;
            case 'cancel':
                $transaction->update([
                    'payment_status' => 'failed',
                ]);
                break;
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}

