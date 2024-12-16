@extends('layouts.checkout')

@section('title', 'Dodolan - Checkout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center"><strong>Checkout Page</strong></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul id="order-summary" class="list-group">
                        <!-- JavaScript will populate this -->
                    </ul>
                    <div class="mt-3 text-end">
                        <strong>Total: Rp. <span id="total-price">{{ number_format(0, 0, ',', '.') }}</span></strong>
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
                    <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}">
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
                            <label for="payment-method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment-method" name="payment_method" required>
                            </select>
                        </div>
                        <input type="hidden" id="cart-data" name="cart_data"> <!-- Hidden input for cart data -->
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #ff9000">Confirm Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const orderSummary = document.getElementById('order-summary');
    const totalPriceElement = document.getElementById('total-price');
    const cartDataInput = document.getElementById('cart-data');
    const nameInput = document.getElementById('name'); // Reference to the name field

    // Fetch cart data from localStorage
    const cartData = JSON.parse(localStorage.getItem('cart')) || [];
    let totalPrice = 0;

    // Populate name field from localStorage if available
    const savedName = localStorage.getItem('user_name');
    if (savedName) {
        nameInput.value = savedName; // Set the saved name into the input field
    }

    // Clear existing content
    orderSummary.innerHTML = '';

    if (cartData.length > 0) {
        cartData.forEach(item => {
            const itemTotal = item.qty * item.price;
            totalPrice += itemTotal;

            // Add item to the order summary
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between';
            li.innerHTML = `
                <div>
                    <strong>${item.name}</strong> <br>
                    <small>Quantity: ${item.qty}</small>
                </div>
                <span>Rp. ${new Intl.NumberFormat('id-ID').format(itemTotal)}</span>
            `;
            orderSummary.appendChild(li);
        });
    } else {
        const li = document.createElement('li');
        li.className = 'list-group-item text-center';
        li.textContent = 'Your cart is empty!';
        orderSummary.appendChild(li);
    }

    // Update total price
    totalPriceElement.textContent = new Intl.NumberFormat('id-ID').format(totalPrice);

    cartDataInput.value = JSON.stringify(cartData);
});

</script>
@endsection


