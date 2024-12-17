@extends('layouts.app')

@section('title', 'Dodolan')

@section('content')
<section style="background: linear-gradient(135deg, #ffa07a, #FF9900); min-height: 100vh; width: 100%; margin: 0; padding: 0;">
    <section class="py-5 store">
        <h1 class="text-center store-title">List Produk</h1>
        <div class="mt-4 store-search-container justify-content-center align-items-center">
            <form action="{{ route('list.toko') }}" method="GET" class="d-flex justify-content-center">
                <input
                    type="text"
                    name="product_name"
                    class="custom-input-toko"
                    placeholder="Cari produk berdasarkan nama..."
                    value="{{ request('product_name') }}">
                <button type="submit" style="display: none;"></button>
            </form>
        </div>
        <section class="container">
            <div class="container">
                <div class="mt-5 row">
                    @foreach ($products as $product)
                        <div class="mb-3 col-6 col-lg-3 col-md-6">
                            <div class="card card-product">
                                <a href="{{ route('store.show', $product->store->username) }}" class="text-decoration-none">
                                    <img src="{{ asset('storage/' . $product->store->logo) }}" alt="image" class="card-img-top">
                                    <h5 class="mt-3 card-text" style="font-size: 1.4rem; font-weight: bold;">{{ $product->name }}</h5>
                                    <p class="mt-2 card-text">{{ Str::limit($product->description, 50) }}</p>
                                    <p class="mt-2 card-text" style="font-size: 1.2rem; font-weight: bold;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </a>
                                <a href="{{ route('store.product.show.detail', [$product->store->username, $product->slug]) }}" class="mt-3 btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </section>
</section>
@endsection

