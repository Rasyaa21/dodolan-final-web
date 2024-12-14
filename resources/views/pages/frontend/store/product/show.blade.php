@extends('layouts.store')

@section('title', 'Detail Produk')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Image {{ $index + 1 }}" style="object-fit: contain;">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="flex-wrap gap-2 mt-4 d-flex">
                        @foreach ($product->images as $index => $image)
                            <a href="#" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" class="d-block">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="Image {{ $index + 1 }}" style="width: 100px; height: 100px; object-fit: contain;">
                            </a>
                        @endforeach
                    </div>

                    <h1 class="mt-4 mb-3" style="font-size: 2rem;">{{ $product->name }}</h1>
                    <p class="mb-2 text-muted">Reference: {{ $product->reference }}</p>
                    <h3 class="mb-3 text-primary">Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
                    <p class="mb-4">{{ $product->description }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Slug:</strong> {{ $product->slug }}</p>
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail {{ $product->name }}" class="mt-3 img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
