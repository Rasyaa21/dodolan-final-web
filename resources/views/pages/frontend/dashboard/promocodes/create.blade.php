@extends('layouts.store')

@section('title', 'Tambah Kode Promo')


@section('content')
<section class="section">
    <div class="card" style="margin: 2rem;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tambah Kode Promo</h4>
            <a href="{{ route('store.dashboard', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('store.promo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="store_id" value="{{ request()->route('store') }}">

                <div class="mb-3">
                    <label for="code" class="form-label">Kode Promo</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        name="code" placeholder="Masukkan Kode Promo" value="{{ strtoupper(old('code') ?? '') }}"
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
                        name="amount" placeholder="Masukkan stok produk" value="{{ old('amount') }}">
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
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Nominal</option>
                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persen</option>
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
                        name="placeholder_discount_amount" placeholder="Masukkan Diskon" value="{{ old('placeholder_discount_amount') ?? '' }}"
                        oninput="validateDiscount(this)">
                    <input type="hidden" name="discount_amount" id="discount_amount" :value="unformatRupiah(placeholder_discount_amount.value)">
                    @error('discount_amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="valid_until" class="form-label">Tgl Kadaluarsa</label>
                    <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until"
                        name="valid_until" placeholder="Masukkan Tgl Kadaluarsa" value="{{ old('valid_until') ?? '' }}">

                    @error('valid_until')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah Kode Promo</button>
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

        document.getElementById('discount').addEventListener('input', (e) => {
            validateDiscount(e.target);
        });
    </script>
@endsection

