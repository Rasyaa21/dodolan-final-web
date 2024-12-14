<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodolan - @yield('title')</title>
    <script src="{{ asset('assets/admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/ui-apexchart.js') }}"></script>
    <script src="{{ asset('assets/admin/js/feather-icons/feather.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/toastify-js/src/toastify.css') }}">
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/filepond.js') }}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/table-datatable.css') }}">
</head>

<body>
    <script src="{{ asset('assets/admin/js/initTheme.js') }}"></script>

    <div id="app">
        @include('includes.admin-sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>

            <div class="page-content">
                @include('sweetalert::alert')

                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/js/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.esm.js') }}"></script>
    @yield('scripts')
</body>

</html>

