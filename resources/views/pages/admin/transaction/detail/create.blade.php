@extends('layouts.admin')

@section('title', 'Tambah Detail Transaksi')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tambah Detail Transaksi</h4>
            <div>
                <a href="{{ route('admin.transaction.create', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transaction-detail.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="store_id" value="{{ request()->route('store') }}">

                <div class="mb-3">
                    <label for="product_id" class="form-label">Produk</label>
                    <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                        <option selected disabled value="">Pilih Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="transaction_id" class="form-label">Transaksi</label>
                    <select class="form-select @error('transaction_id') is-invalid @enderror" id="transaction_id" name="transaction_id">
                        <option selected disabled value="">Pilih Transaksi</option>
                        @foreach ($transactions as $transaction)
                            <option value="{{ $transaction->id }}" {{ old('transaction_id') == $transaction->id ? 'selected' : '' }}>
                                {{ $transaction->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('transaction_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="Masukkan Jumlah" value="{{ old('quantity') }}">
                    @error('quantity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah Transaksi Detail</button>
            </form>
        </div>
    </div>
</section>

@endsection

