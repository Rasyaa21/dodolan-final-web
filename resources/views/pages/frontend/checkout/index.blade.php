@extends('layouts.checkout')

@section('title', 'Dodolan - Checkout')

@section('content')
    @csrf
    <div class="container mt-5">
        <h1 class="mb-4 text-center"><strong>Pembayaran</strong></h1>
        <div class="row">
            <!-- Order Summary Section -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <ul id="order-summary" class="list-group">
                            <!-- JavaScript will populate this -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Payment Information Section -->
            <div class="col-md-4">
                <div class="card">
                <div class="card-header">
                        <h5>Informasi Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 mb-4 rounded price-summary bg-light">
                            <div class="row">
                                <div class="col-7"><strong>Harga Asli :</strong></div>
                                <div class="col-5 text-end">Rp. <span id="original-price">0</span></div>
                            </div>
                            <div class="mt-2 row">
                                <div class="col-7"><strong>Diskon :</strong></div>
                                <div class="col-5 text-end">Rp. <span id="discount-amount">0</span></div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-7"><strong>Total :</strong></div>
                                <div class="col-5 text-end"><strong>Rp. <span id="final-price">0</span></strong></div>
                            </div>
                        </div>

                        <form id="checkout-form" method="POST"
                            action="{{ route('checkout.process', ['store' => $store->id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">No Telp</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="promo_code" class="form-label">Kode Promo</label>
                                <select class="form-control" id="promo_code" name="promo_code">
                                    <option value="">Pilih Kode Promo</option>
                                    @foreach ($store->promocodes as $promocode)
                                        @if ($promocode->amount > 0 && (!$promocode->valid_until || \Carbon\Carbon::parse($promocode->valid_until)->isFuture()))
                                            <option value="{{ $promocode->code }}"
                                                data-discount="{{ $promocode->discount_amount }}"
                                                data-discount-type="{{ $promocode->discount_type }}">
                                                {{ $promocode->code }} - {{ $promocode->description }}
                                                ({{ $promocode->discount_type === 'percentage' ? $promocode->discount_amount . '%' : 'Rp. ' . number_format($promocode->discount_amount, 0, ',', '.') }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Hidden Inputs for Cart Data -->
                            <input type="hidden" id="store-id" name="store_id" value="{{ $store->id }}">
                            <input type="hidden" id="original-price-input" name="original_price">
                            <input type="hidden" id="discount-input" name="discount">
                            <input type="hidden" id="final-price-input" name="final_price">
                            <input type="hidden" id="cart-data" name="cart_data">

                            <button type="submit" class="mb-3 btn btn-primary w-100" id="pay-button"
                                style="background-color: #ff9000">Konfirmasi Bayar</button>
                            <button type="button" id="clear-cart" class="btn btn-danger w-100">Hapus Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderSummary = document.getElementById('order-summary');
            const originalPriceElement = document.getElementById('original-price');
            const discountAmountElement = document.getElementById('discount-amount');
            const finalPriceElement = document.getElementById('final-price');
            const promoCodeSelect = document.getElementById('promo_code');
            const clearCartButton = document.getElementById('clear-cart');

            const cartDataInput = document.getElementById('cart-data');
            const originalPriceInput = document.getElementById('original-price-input');
            const discountInput = document.getElementById('discount-input');
            const finalPriceInput = document.getElementById('final-price-input');

            let cartData = JSON.parse(localStorage.getItem('cart')) || [];
            let originalPrice = 0;

            cartDataInput.value = JSON.stringify(cartData);

            // Function to update the order summary
            function updateOrderSummary() {
                orderSummary.innerHTML = '';
                originalPrice = 0;

                cartData.forEach((item, index) => {
                    const itemTotal = item.qty * item.original_price;
                    originalPrice += itemTotal;

                    const li = document.createElement('li');
                    li.className = 'list-group-item';
                    li.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${item.name}</strong> <br>
                        <small>Quantity: ${item.qty} x Rp. ${new Intl.NumberFormat('id-ID').format(item.original_price)}</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3">Rp. ${new Intl.NumberFormat('id-ID').format(itemTotal)}</span>
                        <button class="btn btn-sm btn-danger delete-item" data-index="${index}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
                    orderSummary.appendChild(li);

                    // Delete item event
                    li.querySelector('.delete-item').addEventListener('click', function() {
                        cartData.splice(index, 1);
                        localStorage.setItem('cart', JSON.stringify(cartData));
                        updateOrderSummary();
                        updatePrices();
                    });
                });

                updatePrices();
            }

            function updatePrices() {
                originalPriceElement.textContent = new Intl.NumberFormat('id-ID').format(originalPrice);
                originalPriceInput.value = originalPrice;

                let discount = 0;
                const selectedOption = promoCodeSelect.selectedOptions[0];
                if (selectedOption && selectedOption.value) {
                    const discountAmount = parseFloat(selectedOption.dataset.discount);
                    const discountType = selectedOption.dataset.discountType;

                    discount = discountType === 'percentage' ? (discountAmount / 100) * originalPrice : Math.min(
                        discountAmount, originalPrice);
                }

                discountAmountElement.textContent = new Intl.NumberFormat('id-ID').format(discount);
                discountInput.value = discount;

                const finalPrice = originalPrice - discount;
                finalPriceElement.textContent = new Intl.NumberFormat('id-ID').format(finalPrice);
                finalPriceInput.value = finalPrice;

                cartDataInput.value = JSON.stringify(cartData);
            }

            clearCartButton.addEventListener('click', function() {
                if (confirm('Apakah Kamu Serius Ingin Menghapus Keranjang?')) {
                    localStorage.removeItem('cart');
                    cartData = [];
                    updateOrderSummary();
                }
            });

            promoCodeSelect.addEventListener('change', updatePrices);

            updateOrderSummary();
        });
    </script>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onPending: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection