@extends('layouts.admin')

@section('title', 'Edit Kode Promo')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Edit Kode Promo</h4>
            <a href="{{ route('admin.store.show', $code->store_id) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.promo.update', $code->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="store_id" value="{{ $code->store_id }}">

                <div class="mb-3">
                    <label for="code" class="form-label">Kode Promo</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        name="code" placeholder="Masukkan Kode Promo" value="{{ old('code', strtoupper($code->code)) }}"
                        oninput="this.value = this.value.toUpperCase()">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Jumlah Kode Promo</label>
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                        name="amount" placeholder="Masukkan jumlah kode promo" value="{{ old('amount', $code->amount) }}">
                    @error('amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discount_type" class="form-label">Tipe Diskon</label>
                    <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type"
                        name="discount_type">
                        <option selected disabled value="">Pilih Tipe Diskon</option>
                        <option value="fixed" {{ old('discount_type', $code->discount_type) == 'fixed' ? 'selected' : '' }}>Nominal</option>
                        <option value="percentage" {{ old('discount_type', $code->discount_type) == 'percentage' ? 'selected' : '' }}>Persen</option>
                    </select>
                    @error('discount_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="placeholder_discount_amount" class="form-label">Diskon</label>
                    <input type="text" class="form-control @error('placeholder_discount_amount') is-invalid @enderror" id="placeholder_discount_amount"
                        name="placeholder_discount_amount" placeholder="Masukkan Diskon"
                        value="{{ old('placeholder_discount_amount', number_format($code->discount_amount, 0, ',', '.')) }}"
                        oninput="validateDiscount(this)">
                    <input type="hidden" name="discount_amount" id="discount_amount"
                        value="{{ old('discount_amount', $code->discount_amount) }}">
                    @error('discount_amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="valid_until" class="form-label">Tgl Kadaluarsa</label>
                    <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until"
                        name="valid_until" value="{{ old('valid_until', date('Y-m-d', strtotime($code->valid_until))) }}">
                    @error('valid_until')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Kode Promo</button>
            </form>
        </div>
    </div>
</section>

<script>
    function validateDiscount(input) {
        const discountType = document.getElementById('discount_type').value;
        let rawValue = input.value.replace(/[^0-9]/g, '');
        if (discountType === 'percentage') {
            const value = parseFloat(rawValue);
            if (value > 100) {
                input.value = 100;
            } else if (!isNaN(value)) {
                input.value = value;
            }
        } else if (discountType === 'fixed') {
            input.value = toRupiah(rawValue);
        }
        document.getElementById('discount_amount').value = unformatRupiah(input.value);
    }

    const toRupiah = (angka) => {
        angka = angka.toString().replace(/[^,\d]/g, '');
        let split = angka.split(/[,\.]/);
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        let separator;

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    };

    const unformatRupiah = (rupiah) => {
        return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
    };
</script>
@endsection

