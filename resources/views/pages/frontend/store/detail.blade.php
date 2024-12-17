detail.blade

@extends('layouts.store')

@section('title', 'Detail Produk')

@section('content')
    <div class="container p-4">
        <div class="mt-3 row">
            <div class="mb-3 col-12 col-md-6 col-lg-4 mb-md-0 mb-lg-0">
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
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('cart-count').innerText =
            `(${cart.reduce((prev, curr) => prev + curr.qty, 0)})`;


            let quantity = 1;

            const qtyDisplay = document.getElementById('qty-display');
            const addToCartButton = document.getElementById('add-to-cart');
            const maxStock = parseInt(addToCartButton.dataset.max_stock, 10);

            const updateQtyDisplay = () => {
                qtyDisplay.innerText = quantity;
            };

            document.getElementById('increase-qty').addEventListener('click', () => {
                if (quantity < maxStock) {
                    quantity++;
                    updateQtyDisplay();
                } else {
                    alert('Jumlah produk melebihi stok yang tersedia!');
                }
            });

            document.getElementById('decrease-qty').addEventListener('click', () => {
                if (quantity > 1) {
                    quantity--;
                    updateQtyDisplay();
                }
            });

            addToCartButton.addEventListener('click', () => {
                const productId = addToCartButton.dataset.product_id;
                const price = parseInt(addToCartButton.dataset.price, 10);
                const name = addToCartButton.dataset.name;
                const totalPrice = price * quantity;

                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                const existingProduct = cart.find(item => item.product_id === productId);

                if (existingProduct) {
                    existingProduct.qty += quantity;
                    existingProduct.price = existingProduct.original_price * existingProduct.qty;
                } else {
                    cart.push({
                        product_id: productId,
                        name: name,
                        qty: quantity,
                        original_price: price,
                        price: totalPrice
                    });
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                const cartCount = cart.reduce((prev, curr) => prev + curr.qty, 0);
                document.getElementById('cart-count').innerText = `(${cartCount})`;

                alert('Produk berhasil ditambahkan ke keranjang!');
            });

            updateQtyDisplay();
        });
    </script>
@endsection
