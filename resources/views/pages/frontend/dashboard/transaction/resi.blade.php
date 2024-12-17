@extends('layouts.checkout')

@section('title', 'Edit Transaksi')

@section('content')
<section class="section">
    <div class="card" style="margin: 2rem">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">No Resi</h4>
            <a href="{{ route('store.dashboard', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('store.transaction.resi.create', ['transaction' => $transaction->id, 'store' => $transaction->store_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="payment_status" class="form-label">Status Pembayaran</label>
                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                        <option selected disabled value="">Pilih Status</option>
                        <option value="pending" {{ old('payment_status', $transaction->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('payment_status', $transaction->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ old('payment_status', $transaction->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="receipt_number" class="form-label">No Resi</label>
                    <input type="text" class="form-control @error('receipt_number') is-invalid @enderror" id="receipt_number"
                        name="receipt_number" placeholder="Masukkan No Resi" value="{{ old('receipt_number', $transaction->receipt_number) }}">
                    @error('receipt_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Transaksi</button>
            </form>
        </div>
    </div>
</section>
@endsection

