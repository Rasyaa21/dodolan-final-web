@extends('layouts.admin')

@section('title', 'Edit Transaksi')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">No Resi</h4>
            <a href="{{ route('admin.store.show', $transaction->store_id) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transaction.resi.add', ['transaction' => $transaction->id, 'store' => $transaction->store_id]) }}" method="POST" enctype="multipart/form-data">
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
                    <label for="no_resi" class="form-label">No Resi</label>
                    <input type="text" class="form-control @error('no_resi') is-invalid @enderror" id="no_resi"
                        name="no_resi" placeholder="Masukkan No Resi" value="{{ old('no_resi', $transaction->no_resi) }}">
                    @error('no_resi')
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

