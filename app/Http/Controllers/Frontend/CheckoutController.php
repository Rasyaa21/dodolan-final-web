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
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Repositories\TransactionRepository;
use GuzzleHttp\Client;

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
    public function process(Request $request)
    {
        $carts = json_decode($request->cart_data);
        $originalPrice = 0;
        $discount = 0;
        $finalPrice = 0;

        // Validasi jika $carts adalah array
        if (!is_array($carts)) {
            return redirect()->back()->withErrors(['error' => 'Invalid cart data']);
        }

        foreach ($carts as $cart) {
            // Pastikan properti yang diakses ada
            $cart->price = isset($cart->price) ? $cart->price : 0;
            $cart->qty = isset($cart->qty) ? $cart->qty : 0;
            $cart->discount = isset($cart->discount) ? $cart->discount : 0;

            $originalPrice += $cart->price * $cart->qty;
            $discount += $cart->discount * $cart->qty;
            $finalPrice += ($cart->price - $cart->discount) * $cart->qty;
        }

        try {
            DB::beginTransaction();

            // Buat transaksi utama
            $transaction = Transaction::create([
                'code' => 'TX-' . Str::upper(Str::random(8)),
                'store_id' => $request->store_id,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'receipt_number' => 'TX-' . Str::upper(Str::random(8)),
                'original_price' => $originalPrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
            ]);

            // Tambahkan detail transaksi
            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                ]);

                // Update stok produk
                $product = Product::find($cart->product_id);
                if ($product) {
                    $product->stock = max(0, $product->stock - $cart->qty);
                    $product->save();
                }
            }

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => [
                    'order_id' => $transaction->code,
                    'gross_amount' => $transaction->final_price,
                ]
            );

            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            return redirect($paymentUrl);


            // Kirim pesan via Fonnte
            //  $this->sendResiNotification($transaction->receipt_number, $transaction->customer_phone, $transaction->customer_name);

            DB::commit();

            return view('pages.frontend.checkout.success', compact('snapToken'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Checkout Process Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to process the transaction.']);
        }
    }

    /**
     * Kirim pesan via Fonnte
     */
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
                throw new Exception('Gagal mengirim pesan: ' . ($responseBody['message'] ?? 'Unknown error'));
            }
        } catch (Exception $e) {
            Log::error('Gagal mengirim pesan via Fonnte: ' . $e->getMessage());
            throw new Exception('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }




    public function success()
    {
        return view('pages.frontend.checkout.success');
    }
}

