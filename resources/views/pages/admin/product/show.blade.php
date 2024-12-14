@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<style>
    body {
        background-color: #d3dfe8;
    }

    .product-detail {
        background-color: #FFFFFF;
        padding: 20px;
        border-radius: 10px;
        margin: 20px auto;
        max-width: 600px;
    }

    .product-image {
        width: 100%;
        border-radius: 10px;
    }

    .thumbnail {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        margin: 5px;
    }

    .btn-size,
    .btn-color {
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 5px 15px;
        margin: 5px;
        cursor: pointer;
    }

    .btn-buy {
        background-color: #435ebe;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        width: 100%;
        font-size: 18px;
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .rating i {
        color: #ffcc00;
    }

    .rating span {
        margin-left: 5px;
    }
</style>
<div class="container">
    <div class="product-detail">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="text-dark" href="#">
                <i class="fas fa-arrow-left">
                </i>
            </a>
            <h5 class="m-0">
                Detail Produk
            </h5>
            <div>
            </div>
        </div>
        <img alt="Product Image" class="product-image mb-3" height="400" src="{{ asset('storage/' . $product->thumbnail) }}" width="300" height="300" />
        <div class="d-flex justify-content-center mb-3">
            @foreach ($product->images as $image)
            <img alt="Thumbnail image of a pizza" class="thumbnail" height="50" src="{{ asset('storage/' . $image->path) }}" width="50" />
            @endforeach

        </div>
        <h4>
            {{ $product->name }}
        </h4>
        <h5>
            Rp. {{ number_format($product->price, 0, ',', '.') }}
        </h5>
        <p>
            {{ $product->description }}
        </p>
        <div class="mb-3">
            <h6>
                Stock: {{$product->stock}}
            </h6>
        </div>
        <div class="mb-3">
            <h6>
                Visitor: {{$product->visitor}}
            </h6>
        </div>
        <button class="btn-buy">
            Beli Sekarang
        </button>
    </div>
</div>
@endsection