@extends('layouts.admin')

@section('title', 'Tambah Transaksi')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tambah Transaksi</h4>
            <div>
                <a href="{{ route('admin.detail.create', request()->route('store')) }}" class="btn btn-primary">Tambah Transaction Detail</a>
                <a href="{{ route('admin.store.show', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transaction.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="store_id" value="{{ request()->route('store') }}">

                <div class="mb-3">
                    <label for="code" class="form-label">ID Order</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        name="code" placeholder="Masukkan ID Order" value="TX-{{ str_pad(old('code') ?? '1', 4, '0', STR_PAD_LEFT) }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name"
                        name="customer_name" placeholder="Masukkan Nama Pelanggan" value="{{ old('customer_name') }}">
                    @error('customer_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customer_phone" class="form-label">Nomor HP Pelanggan</label>
                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone"
                        name="customer_phone" placeholder="Masukkan Nomor HP Pelanggan" value="{{ old('customer_phone') }}">
                    @error('customer_phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customer_address" class="form-label">Alamat Pelanggan</label>
                    <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address"
                        name="customer_address" placeholder="Masukkan Alamat Pelanggan">{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="original_price" class="form-label">Harga</label>
                    <input
                        type="text"
                        class="form-control @error('original_price') is-invalid @enderror"
                        id="formatted_original_price"
                        name="formatted_original_price"
                        placeholder="Masukkan Harga"
                        value="{{ old('original_price') ? number_format(old('original_price'), 0, ',', '.') : '' }}"
                        oninput="formatPrice('formatted_original_price', 'original_price')"
                    >
                    <input
                        type="hidden"
                        id="original_price"
                        name="original_price"
                        value="{{ old('original_price', 0) }}"
                    >
                    @error('original_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shipping_fee" class="form-label">Biaya Pengiriman</label>
                    <input
                        type="text"
                        class="form-control @error('shipping_fee') is-invalid @enderror"
                        id="formatted_shipping_fee"
                        name="formatted_shipping_fee"
                        placeholder="Masukkan Biaya Pengiriman"
                        value="{{ old('shipping_fee') ? number_format(old('shipping_fee'), 0, ',', '.') : '' }}"
                        oninput="formatPrice('formatted_shipping_fee', 'shipping_fee')"
                    >
                    <input
                        type="hidden"
                        id="shipping_fee"
                        name="shipping_fee"
                        value="{{ old('shipping_fee', 0) }}"
                    >
                    @error('shipping_fee')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <script>
                    function formatPrice(visibleFieldId, hiddenFieldId) {
                        const visibleField = document.getElementById(visibleFieldId);
                        const hiddenField = document.getElementById(hiddenFieldId);
                        let inputValue = visibleField.value.replace(/[^0-9]/g, '');
                        const formattedValue = new Intl.NumberFormat('id-ID').format(inputValue);
                        visibleField.value = formattedValue;
                        hiddenField.value = inputValue;
                    }
                </script>

                <div class="mb-3">
                    <label for="payment_status" class="form-label">Status Pembayaran</label>
                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status"
                        name="payment_status">
                        <option selected disabled value="">Pilih Status Pembayaran</option>
                        <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ old('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="promo_code_id" class="form-label">Kode Promo</label>
                    <select class="form-select @error('promo_code_id') is-invalid @enderror" id="promo_code_id"
                        name="promo_code_id" onchange="updateDiscountAmount()">
                        <option selected disabled value="">Pilih Kode Promo</option>
                        @foreach ($codes as $code)
                            <option value="{{ $code->id }}" data-discount-amount="{{ $code->discount_amount }}" {{ old('promo_code_id') == $code->id ? 'selected' : '' }}>
                                {{ $code->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('promo_code_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="hidden" name="promo_code_id" value="{{ old('promo_code_id', request()->query('promo_code_id')) }}">

                <div class="mb-3">
                    <label for="discount_amount" class="form-label">Diskon</label>
                    <input type="hidden" id="discount_amount" name="discount_amount" value="{{ old('discount_amount', 0) }}">
                    <input type="text" class="form-control @error('discount_amount') is-invalid @enderror"
                        id="discount_amount_display" value="Rp {{ number_format(old('discount_amount', 0), 0, ',', '.') }}" readonly>
                    @error('discount_amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="final_price" class="form-label">Total Harga</label>
                    <input
                        type="hidden"
                        id="final_price"
                        name="final_price"
                        value="{{ (old('original_price', 0) + old('shipping_fee', 0)) - old('discount_amount', 0) }}">
                    <input
                        type="text"
                        class="form-control @error('final_price') is-invalid @enderror"
                        id="final_price"
                        value="Rp {{ number_format((old('original_price', 0) + old('shipping_fee', 0)) - old('discount_amount', 0), 0, ',', '.') }}"
                        readonly>
                    @error('final_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
            </form>
        </div>
    </div>
</section>

<script>
    function updatePrice() {
    const originalPrice = parseFloat(document.getElementById('original_price')?.value || 0);
    const shippingFee = parseFloat(document.getElementById('shipping_fee')?.value || 0);
    const discountAmount = parseFloat(document.getElementById('discount_amount')?.value || 0);

    const totalPrice = originalPrice + shippingFee - discountAmount;

    document.getElementById('final_price').value = totalPrice;

    document.getElementById('final_price_display').value = `Rp ${Math.max(totalPrice, 0).toLocaleString('id-ID')}`;
}


    function updateDiscountAmount() {
        const promoCodeSelect = document.getElementById('promo_code_id');
        const discountAmountInput = document.getElementById('discount_amount');
        const discountDisplay = document.getElementById('discount_amount_display');

        const selectedOption = promoCodeSelect.options[promoCodeSelect.selectedIndex];
        const discountAmount = parseFloat(selectedOption?.dataset.discountAmount || 0);

        discountAmountInput.value = discountAmount;
        discountDisplay.value = `Rp ${discountAmount.toLocaleString('id-ID')}`;

        updatePrice();
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('formatted_original_price').addEventListener('input', () => {
            formatPrice('formatted_original_price', 'original_price');
            updatePrice();
        });

        document.getElementById('formatted_shipping_fee').addEventListener('input', () => {
            formatPrice('formatted_shipping_fee', 'shipping_fee');
            updatePrice();
        });

        updatePrice();
    });
</script>

@endsection


