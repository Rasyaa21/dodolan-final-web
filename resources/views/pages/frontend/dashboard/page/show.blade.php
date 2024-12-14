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
</head>

<body>

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
</head>

<body>

    <div class="container">
        <div class="py-5 row">
            <div class="col-12 col-md-6 col-lg-5">
                <img src="@/assets/images/slide/01.png" alt="product" class="mb-3 w-100 product-image">

                <div class="gap-2 overflow-auto d-flex align-items-center">
                    <img src=" @/assets/images/slide/02.png" alt="product" class="product-image-small">
                    <img src="@/assets/images/slide/03.png" alt="product" class="product-image-small">
                    <img src="@/assets/images/slide/04.png" alt="product" class="product-image-small">
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-7">
                <h2 class="product-title">Classic Taper</h2>
                <div class="gap-2 mb-3 d-flex align-items-center">
                    <p>104 reviews </p>
                </div>

                <p class="product-description">
                    Gaya rambut Classic Taper adalah pilihan yang sempurna bagi Anda yang menginginkan tampilan klasik
                    namun tetap elegan dan modern. Dengan sisi rambut yang dipotong meruncing, gaya ini memberikan kesan
                    rapi dan profesional, cocok untuk semua suasana, baik formal maupun santai.
                </p>

                <div class="gap-2 d-flex align-items-center justify-content-between ">
                    <h3 class="product-price">Rp. 50.000</h3>
                    <a href="/checkout" class="btn btn-gold">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <a class="watermark" href="{{ route('landing') }}">
        Dibuat dengan Dodolan
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
