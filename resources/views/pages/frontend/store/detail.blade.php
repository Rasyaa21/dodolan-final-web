@extends('layouts.store')

@section('title', 'Detail Produk')

@section('content')
<div class="py-5 container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="row">
                <div class="mb-4 col-md-7">
                    <div class="p-2 border-0 rounded card">
                        <div class="card-body">
                            <div class="mb-4 d-flex justify-content-center">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                    alt="Thumbnail {{ $product->name }}"
                                    class="rounded img-fluid"
                                    style="max-width: 100%; height: auto; object-fit: cover;">
                            </div>
                            <h1 class="mt-4 mb-3" style="font-size: 2.5rem; font-weight: bold;">{{ $product->name }}</h1>
                            <h3 class="mb-3 text-primary">Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
                            <div style="max-height: 200px; overflow-y: auto;">
                                <p class="mb-4">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-3 border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <h4 class="mb-3 text-center">Tambah ke Keranjang</h4>
                            <div class="mb-4">
                                <label for="qty-input" class="form-label">Jumlah Produk</label>
                                <div class="gap-3 d-flex align-items-center">
                                    <button id="decrease-qty" class="btn btn-secondary">-</button>
                                    <span id="qty-display" class="text-center form-control" style="width: 3rem;">1</span>
                                    <button id="increase-qty" class="btn btn-secondary">+</button>
                                    <span class="ms-2" style="font-size: 1.2rem; font-weight: bold; color: black;">
                                        Stok Tersedia: <span id="available-stock">{{ $product->stock }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="gap-2 d-grid">
                                <button
                                    class="px-4 py-2 text-white btn btn-warning"
                                    style="background-color: #ff9000"
                                    id="add-to-cart"
                                    data-product_id="{{ $product->id }}"
                                    data-price="{{ $product->price }}"
                                    data-max_stock="{{ $product->stock }}">
                                    <i class="bi-cart-fill me-1"></i> Tambah ke Keranjang
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let quantity = 1;

    const qtyDisplay = document.getElementById('qty-display');
    const addToCartButton = document.getElementById('add-to-cart');
    const maxStock = parseInt(addToCartButton.getAttribute('data-max_stock'));

    document.getElementById('increase-qty').addEventListener('click', function () {
        if (quantity < maxStock) {
            quantity++;
            qtyDisplay.innerText = quantity;
        } else {
            alert('Jumlah produk melebihi stok yang tersedia!');
        }
    });

    document.getElementById('decrease-qty').addEventListener('click', function () {
        if (quantity > 1) {
            quantity--;
            qtyDisplay.innerText = quantity;
        }
    });

    addToCartButton.addEventListener('click', function () {
        const productId = this.getAttribute('data-product_id');
        const price = parseInt(this.getAttribute('data-price'));
        const totalPrice = price * quantity;

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart.push({
            product_id: productId,
            qty: quantity,
            price: totalPrice
        });

        localStorage.setItem('cart', JSON.stringify(cart));

        alert('Produk berhasil ditambahkan ke keranjang!');
    });
</script>
@endsection
