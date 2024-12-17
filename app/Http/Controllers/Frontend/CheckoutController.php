<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use PhpParser\JsonDecoder;
use App\Models\PromoCode;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Repositories\TransactionRepository;

class CheckoutController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function index(Request $request)
    {
        $storeId = request()->route('store');
        $store = Store::find($storeId);
        return view('pages.frontend.checkout.index', compact('store'));
    }

    public function process(CheckoutRequest $request)
    {
        $data = $request->validated();
        $cartData = json_decode($request->cart_data, true);

        if (is_null($cartData) || empty($cartData)) {
            return back()->withErrors(['cart_data' => 'Keranjang kosong atau data tidak valid.']);
        }
        $promoCode = null;
        if ($request->promo_code) {
            $promoCode = PromoCode::where('code', $request->promo_code)
                ->where(function ($query) {
                    $query->whereNull('valid_until')
                        ->orWhere('valid_until', '>=', now());
                })
                ->where('amount', '>', 0)
                ->first();

            if (!$promoCode) {
                return back()->withErrors(['promo_code' => 'Kode promo tidak valid atau sudah habis.']);
            }
        }

        $transaction = $this->transactionRepository->createTransaction($data);

        if ($promoCode) {
            $promoCode->decrement('amount');
        }

        foreach ($cartData as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        return view('pages.frontend.checkout.success');

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
    }


    public function success()
    {
        return view('pages.frontend.checkout.success');
    }
}

