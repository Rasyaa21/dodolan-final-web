@extends('layouts.store')
@section('title', 'Detail Produk')
@section('content')
<section class="py-5">
    <div class="container px-4 my-5 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6 row" style="width: fit-content; height: 700px; background-size: cover; background-position: center;">
                <img class="mb-5 rounded card-img-top mb-md-0" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" style="max-width: 600px; max-height: 100%; object-fit: cover;"/>
            </div>
            <div class="col-md-6">
                <div class="mb-1 text-center small text-md-start">{{ $product->slug }}</div>
                <h1 class="mt-4 mb-3 text-center text-md-start" style="font-size: 3rem; font-weight: bold;">{{ $product->name }}</h1>
                <div class="mb-5 text-center text-md-start fs-5">
                    <h3 class="mb-3 text-primary">Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
                </div>
                <p class="text-center lead text-md-start">{{ $product->description }}</p>
                <div class="d-flex justify-content-center justify-content-md-start">
                    <input class="text-center form-control me-3" id="quantity" type="num" value="1" style="max-width: 3rem" />
                    <button class="py-2 btn btn-warning w-100" type="button">
                        <i class="bi-cart-fill me-1"></i> Tambah ke keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
