@extends('layouts.checkout')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mt-4 mb-3" style="font-size: 2rem;">Transaksi Detail</h1>
                        <a href="{{ route('store.dashboard', $transaction->store_id) }}" class="btn btn-danger">Kembali</a>
                    </div>
                <div class="card-body">
                    <h4>
                        <div class="mb-3">
                            Status: {{ $transaction->status }}
                            @if ($transaction->payment_status == 'pending')
                                <button class="btn btn-warning btn-sm">Belum Dibayar</button>
                            @elseif ($transaction->payment_status == 'paid')
                                <button class="btn btn-success btn-sm">Sudah Dibayar</button>
                            @else
                                <button class="btn btn-danger btn-sm">Gagal</button>
                            @endif
                        </div>
                    </h4>
                    <div class="mb-3">
                        <p><strong>Kode Transaksi:</strong> {{ $transaction->code }}</p>
                        <p><strong>Nama Pelanggan:</strong> {{ $transaction->customer_name }}</p>
                        <p><strong>No. Telepon:</strong> {{ $transaction->customer_phone }}</p>
                        <p><strong>Alamat:</strong> {{ $transaction->customer_address }}</p>
                        <p><strong>Nomor Resi:</strong> {{ $transaction->receipt_number ?? 'Belum tersedia' }}</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <h4><strong>Rincian Pembayaran</strong></h4>
                        <p><strong>Harga Asli:</strong> Rp. {{ number_format($transaction->original_price, 0, ',', '.') }}</p>
                        <p><strong>Diskon:</strong> Rp. {{ number_format($transaction->discount, 0, ',', '.') }}</p>
                        <h4><strong>Total Harga:</strong> Rp. {{ number_format($transaction->final_price, 0, ',', '.') }}</h4>
                    </div>
                    <hr>
                    <p class="mb-4">{{ $transaction->description }}</p>
                    <div class="mt-4">
                        <h5>Produk yang Dibeli:</h5>
                        <ul class="list-group">
                            @foreach ($transaction->transactionDetails as $detail)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $detail->product->name }}</strong><br>
                                        Rp. {{ number_format($detail->price, 0, ',', '.') }} x {{ $detail->qty }}
                                    </div>
                                    <div>
                                        <strong>Subtotal:</strong> Rp. {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
