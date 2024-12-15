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
                    <ul class="list-group">
                        @foreach ($checkoutItems as $product)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong>{{ $product['product']['name'] }}</strong> <br>
                                <small>Quantity: {{ $product['quantity'] }}</small>
                            </div>
                            <span>${{ $product['price'] * $product['quantity'] }}</span>
                        </li>
                        @endforeach
                    </ul>
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
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment-method" name="payment_method" required>
                                <option value="credit_card">Bank</option>
                                <option value="paypal">COD (Cash on Delivery)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Confirm Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection