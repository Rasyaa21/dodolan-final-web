@extends('layouts.store')

@section('title', 'Detail Produk')

@section('content')
    <div class="container p-4">
        <div class="row mt-3">
            <div class="col-12 col-md-6 col-lg-4 mb-3 mb-md-0 mb-lg-0">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product Image" class="img-fluid">
            </div>

            <div class="col-12 col-md-6 col-lg-8">
                <h2>{{ $product->name }}</h2>
                <p class="mt-2">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stok: {{ $product->stock }}</p>

                <p>
                    {!! $product->description !!}
                </p>

                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-secondary me-2" id="decrease-qty">-</button>
                        <span id="qty-display" class="me-2">1</span>
                        <button class="btn btn-secondary" id="increase-qty">+</button>
                    </div>
                    <button class="btn btn-primary ms-3" id="add-to-cart" data-product_id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                        data-max_stock="{{ $product->stock }}">Tambahkan ke Keranjang</button>
                </div>
            </div>
        </div>
    </div>

    <div class="floating-cart d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center ">
            <i class="fas fa-shopping-cart me-2"></i>
            <p class="mb-0">Keranjang <span id="cart-count">(0)</span></p>
        </div>

        <a href="{{ route('checkout.index', $product->store->id) }}" class="btn btn-primary">
            Lihat Keranjang
        </a>
    </div>

    <script>
        let quantity = 1;

        const qtyDisplay = document.getElementById('qty-display');
        const addToCartButton = document.getElementById('add-to-cart');
        const maxStock = parseInt(addToCartButton.getAttribute('data-max_stock'));

        document.getElementById('increase-qty').addEventListener('click', function() {
            if (quantity < maxStock) {
                quantity++;
                qtyDisplay.innerText = quantity;
            } else {
                alert('Jumlah produk melebihi stok yang tersedia!');
            }
        });

        document.getElementById('decrease-qty').addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                qtyDisplay.innerText = quantity;
            }
        });

        addToCartButton.addEventListener('click', function() {
            const productId = this.getAttribute('data-product_id');
            const price = parseInt(this.getAttribute('data-price'));
            const name = this.getAttribute('data-name');
            const totalPrice = price * quantity;

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart.push({
                product_id: productId,
                name: name,
                qty: quantity,
                original_price: price,
                price: totalPrice
            });

            localStorage.setItem('cart', JSON.stringify(cart));

            alert('Produk berhasil ditambahkan ke keranjang!');
        });
    </script>
@endsection