@extends('layouts.store')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="mt-4 mb-3" style="font-size: 2rem;">Transaksi Detail</h1>
                    <p class="mb-2 text-muted">ID Transaksi: {{ $transaction->id }}</p>
                    <p class="mb-2 text-muted">Tanggal: {{ $transaction->date }}</p>
                    <h3 class="mb-3 text-primary">Total: Rp. {{ number_format($transaction->total, 0, ',', '.') }}</h3>
                    <p class="mb-4">{{ $transaction->description }}</p>
                    <p><strong>Status:</strong> {{ $transaction->status }}</p>
                    <div class="mt-4">
                        <h5>Produk yang Dibeli:</h5>
                        <ul class="list-group">
                            @foreach ($transaction->products as $product)
                                <li class="list-group-item">
                                    <strong>{{ $product->name }}</strong> - Rp. {{ number_format($product->price, 0, ',', '.') }} x {{ $product->pivot->quantity }}
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
