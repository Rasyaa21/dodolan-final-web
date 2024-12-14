<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/store.css') }}">
    <style>
        :root {
            --header-color: {{ $store->header_color }};
            --primary-color: {{ $store->primary_color }};
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ asset('storage/' . $store->logo) }}" alt="Store Image" class="avatar">

        <h1 class="store-name">{{ $store->store_name }}</h1>
        <p class="store-city">{{ $store->city }}</p>
    </div>

    <div class="container">
        <div class="mt-5 row">
            @foreach ($store->products as $product)
                <div class="mb-3 col-6 col-lg-3 col-md-6">
                    <a class="card card-product"
                        href="{{ route('store.product.show.detail', [$store->username, $product->slug]) }}">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="image" class="card-img-top">

                        <h5 class="card-title">{{ $product->name }}</h5>

                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <a class="watermark" href="{{ route('landing') }}">
        Dibuat dengan Dodolan
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

