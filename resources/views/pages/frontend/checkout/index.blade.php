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
                            <input type="hidden" id="store-id" name="store_id" value="{{ $store->id }}">
                            <input type="hidden" id="original-price-input" name="original_price">
                            <input type="hidden" id="discount-input" name="discount">
                            <input type="hidden" id="final-price-input" name="final_price">
                            <input type="hidden" id="cart-data" name="cart_data">

                            <button type="submit" class="mb-3 btn btn-primary w-100"
                                style="background-color: #ff9000">Konfirmasi Bayar</button>
                            <button type="button" id="clear-cart" class="btn btn-danger w-100">Hapus Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const orderSummary = document.getElementById('order-summary');
    const originalPriceElement = document.getElementById('original-price');
    const discountAmountElement = document.getElementById('discount-amount');
    const finalPriceElement = document.getElementById('final-price');
    const clearCartButton = document.getElementById('clear-cart');
    const checkoutForm = document.getElementById('checkout-form');

    const cartDataInput = document.getElementById('cart-data');
    const originalPriceInput = document.getElementById('original-price-input');
    const discountInput = document.getElementById('discount-input');
    const finalPriceInput = document.getElementById('final-price-input');

    let cartData = JSON.parse(localStorage.getItem('cart') || '[]');
    let originalPrice = 0;

    cartDataInput.value = JSON.stringify(cartData);

    function updateOrderSummary() {
        orderSummary.innerHTML = '';
        originalPrice = 0;

        if (cartData.length === 0) {
            orderSummary.innerHTML = '<li class="text-center list-group-item">Keranjang Kosong</li>';
            updatePrices();
            return;
        }

        cartData.forEach((item, index) => {
            const itemTotal = item.qty * item.original_price;
            originalPrice += itemTotal;

            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${item.name}</strong><br>
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

            // Attach delete functionality
            li.querySelector('.delete-item').addEventListener('click', function () {
                cartData.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cartData));
                updateOrderSummary();
            });
        });

        updatePrices();
    }

    function updatePrices() {
        originalPriceElement.textContent = new Intl.NumberFormat('id-ID').format(originalPrice);
        originalPriceInput.value = originalPrice;

        const discount = 0; // Placeholder, add logic for discounts if needed
        discountAmountElement.textContent = new Intl.NumberFormat('id-ID').format(discount);
        discountInput.value = discount;

        const finalPrice = originalPrice - discount;
        finalPriceElement.textContent = new Intl.NumberFormat('id-ID').format(finalPrice);
        finalPriceInput.value = finalPrice;

        cartDataInput.value = JSON.stringify(cartData);
    }

    clearCartButton.addEventListener('click', function () {
        if (confirm('Apakah Kamu Serius Ingin Menghapus Keranjang?')) {
            localStorage.removeItem('cart');
            cartData = [];
            updateOrderSummary();
        }
    });

    // Clear localStorage on form submit
    checkoutForm.addEventListener('submit', function (e) {
        if (cartData.length === 0) {
            e.preventDefault();
            alert('Keranjang kosong, tidak dapat melanjutkan pembayaran.');
            return;
        }

        // Clear cart from localStorage after confirmation
        localStorage.removeItem('cart');
    });

    updateOrderSummary();
});
    </script>
@endsection
