<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dodolan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
</head>

<body class="bg-light">
    @include('sweetalert::alert')

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="p-4 shadow-lg card rounded-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
