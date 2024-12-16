@extends('layouts.app')

@section('title', 'Dodolan - Checkout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4"><strong>Checkout Page</strong></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul id="cart-container" class="list-group">
                        <!-- Cart items will be listed here -->
                    </ul>
                    <div class="mt-3">
                        <strong>Total Price: Rp <span id="total-price">0</span></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Payment</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <!-- Customer Name -->
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Full Name</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="customer_address" class="form-label">Address</label>
                            <textarea name="customer_address" id="customer_address" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Phone Number</label>
                            <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="Bank">Transfer</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn text-light btn-warning w-100">Confirm Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Memastikan ada produk di cart
        if (cart.length === 0) {
            document.getElementById('cart-container').innerHTML = 'Keranjang Anda kosong!';
            return;
        }

        // Function to format number as IDR
        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        let cartHtml = '';
        let totalPrice = 0

        cart.forEach(item => {
            const itemTotalPrice = parseInt(item.price, 10);

            totalPrice += itemTotalPrice

            cartHtml += `
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>Produk ID: ${item.product_id}</strong> <br>
                    <small>Quantity: ${item.qty}</small>
                </div>
                <span>${formatCurrency(itemTotalPrice)}</span> <!-- Manually formatted totalPrice -->
            </li>
        `;
        });

        cartHtml += `
        <li class="list-group-item d-flex justify-content-between">
            <strong>Total Price:</strong>
            <span><strong>${formatCurrency(totalPrice)}</strong></span>
        </li>
        `;

        // Menampilkan cart di halaman checkout
        document.getElementById('cart-container').innerHTML = cartHtml;
    }
</script>
@endsection