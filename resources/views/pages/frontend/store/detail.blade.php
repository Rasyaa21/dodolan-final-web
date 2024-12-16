@extends('layouts.store')

@section('title', 'Detail Produk')

@section('content')
<div class="py-5 container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="p-2 border-0 rounded card">
                <div class="d-flex justify-content-end">
                    <div class="p-2">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-4 col-md-6 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail {{ $product->name }}" class="rounded img-fluid" style="max-width: 100%; height: auto; object-fit: cover;">
                        </div>

                        <div class="col-md-6">
                            <h1 class="mt-4 mb-3" style="font-size: 2.5rem; font-weight: bold;">{{ $product->name }}</h1>
                            <h3 class="mb-3 text-primary">Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
                            <div style="max-height: 200px; overflow-y: auto;">
                                <p class="mb-4">{{ $product->description }}</p>
                            </div>
                            @if($product->stock > 0)
                                <button class="mb-1 btn btn-success"><strong>Tersedia</strong></button>
                            @else
                                <p class="mb-1"><strong>Stock:</strong> {{ $product->stock }}</p>
                            @endif

                            <div class="my-4 text-md-start">
                                <label class="form-label">Jumlah</label>
                                <div class="gap-3 d-flex align-items-center">
                                    <button id="decrease-qty" class="btn btn-secondary">-</button>
                                    <span id="qty-display" class="text-center form-control" style="width: 3rem;">1</span>
                                    <button id="increase-qty" class="btn btn-secondary">+</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center justify-content-md-start">
                                <button
                                class="px-4 py-2 text-white btn btn-warning w-100 w-md-auto"
                                id="add-to-cart"
                                data-product_id="{{ $product->id }}"
                                data-price="{{ $product->price }}"
                                type="button">
                                    <i class="bi-cart-fill me-1"></i> Tambah ke keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    @if($product->images->count() > 0)
                        <div class="mt-4">
                            <h5 class="text-center">Other Images:</h5>
                            <div class="flex-wrap gap-2 d-flex justify-content-center">
                                @foreach ($product->images as $image)
                                    <a href="#" class="d-block">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; transition: transform 0.2s;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let quantity = 1;

    document.getElementById('increase-qty').addEventListener('click', function () {
        quantity++;
        document.getElementById('qty-display').innerText = quantity;
    });

    document.getElementById('decrease-qty').addEventListener('click', function () {
        if (quantity > 1) {
            quantity--;
            document.getElementById('qty-display').innerText = quantity;
        }
    });

    document.getElementById('add-to-cart').addEventListener('click', function () {
        const productId = this.getAttribute('data-product_id');
        const price = parseInt(this.getAttribute('data-price'));
        const totalPrice = price * quantity;

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart.push({
            product_id: productId,
            qty: quantity,
            price: totalPrice,
        });

        localStorage.setItem('cart', JSON.stringify(cart));

        alert('Produk berhasil ditambahkan ke keranjang!');
    });
</script>

<style>
    .img-thumbnail {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .img-thumbnail:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .card {
        background-color: #ffffff;
    }

    .card-body {
        padding: 2rem;
    }

    .btn-danger {
        z-index: 1;
    }
</style>
@endsection
