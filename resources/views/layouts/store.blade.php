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
        <div id="main vertical">
            <div class="page-content">
                @include('sweetalert::alert')
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
        <script src="{{ asset('assets/admin/js/simple-datatables.js') }}"></script>
        <script
            src="{{ asset('assets/admin/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.esm.js') }}">
        </script>
        @yield('scripts')
        <div id="floating-cart" class="bg-white shadow-lg">
            <div class="container py-1">
                <div class="px-3 row align-items-center">
                    <div class="col-auto">
                        <div class="gap-2 d-flex align-items-center">
                            <i class="fas fa-shopping-cart cart-icon"></i>
                            <span id="cart-count" class="cart-count"></span>
                        </div>
                    </div>

                    <div class="col text-end">
                        <div class="gap-4 d-flex align-items-center justify-content-end">
                            <div class="total-section">
                                <span class="total-label">Total</span>
                                <span id="cart-total" class="total-amount"></span>
                            </div>
                            <button onclick="window.location.href = `{{ route('checkout.index', $store->id) }}`"
                                class="checkout-button"
                                style="background-color: #FF9900;">
                                Lanjutkan Pembayaran
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            #floating-cart {
                position: fixed;
                bottom: 1.5rem;
                left: 50%;
                transform: translateX(-50%);
                width: min(90%, 1200px);
                border-radius: 12px;
                z-index: 1050;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                padding: 0.5rem 0;
            }

            .cart-icon {
                font-size: 1.75rem;
                color: #4a5568;
            }

            .cart-count {
                font-size: 1.1rem;
                font-weight: 600;
                color: #2d3748;
                padding-left: 0.5rem;
            }

            .total-section {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                padding-right: 1rem;
            }

            .total-label {
                font-size: 0.925rem;
                color: #718096;
                margin-bottom: 0.25rem;
            }

            .total-amount {
                font-size: 1.35rem;
                font-weight: 700;
                color: #2d3748;
            }

            .checkout-button {
                background-color: #4F46E5;
                color: white;
                border: none;
                border-radius: 8px;
                padding: 1rem 2rem;
                font-size: 1rem;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.2s ease;
            }

            .checkout-button:hover {
                background-color: #4338CA;
                transform: translateY(-1px);
            }

            .checkout-button i {
                font-size: 1.1rem;
            }

            #floating-cart.show {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }

            #floating-cart.hide {
                transform: translateX(-50%) translateY(100%);
                opacity: 0;
            }

            @media (max-width: 768px) {
                #floating-cart {
                    bottom: 1rem;
                    width: 95%;
                    padding: 0.25rem 0;
                }

                .container {
                    padding: 1rem;
                }

                .cart-icon {
                    font-size: 1.5rem;
                }

                .cart-count {
                    font-size: 1rem;
                }

                .total-label {
                    font-size: 0.825rem;
                }

                .total-amount {
                    font-size: 1.2rem;
                }

                .checkout-button {
                    padding: 0.75rem 1.5rem;
                    font-size: 0.925rem;
                }
            }

            @media (max-width: 576px) {
                .gap-4 {
                    gap: 1rem !important;
                }

                .total-section {
                    flex-direction: row;
                    align-items: center;
                    gap: 0.5rem;
                    padding-right: 0.5rem;
                }

                .total-label {
                    margin-bottom: 0;
                }

                .checkout-button {
                    padding: 0.6rem 1.25rem;
                }
            }
        </style>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const floatingCart = document.getElementById('floating-cart');
                const cartCount = document.getElementById('cart-count');
                const cartTotal = document.getElementById('cart-total');

                function updateFloatingCart() {
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];

                    if (cart.length === 0) {
                        floatingCart.classList.remove('d-block');
                        floatingCart.classList.add('d-none');
                        return;
                    }

                    floatingCart.classList.remove('d-none');
                    floatingCart.classList.add('d-block');

                    cartCount.textContent = `(${cart.length})`;

                    const total = cart.reduce((sum, item) => sum + item.price, 0);
                    cartTotal.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;

                    setTimeout(() => {
                        floatingCart.classList.add('show');
                    }, 100);
                }

                window.addEventListener('storage', function(e) {
                    if (e.key === 'cart') {
                        updateFloatingCart();
                    }
                });

                updateFloatingCart();
            });

            const existingAddToCartButton = document.getElementById('add-to-cart');
            if (existingAddToCartButton) {
                const originalClick = existingAddToCartButton.onclick;
                existingAddToCartButton.onclick = function(e) {
                    if (originalClick) originalClick.call(this, e);
                    const floatingCart = document.getElementById('floating-cart');
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    if (cart.length > 0) {
                        floatingCart.classList.remove('d-none');
                        floatingCart.classList.add('d-block', 'show');
                    }
                };
            }
        </script>
</body>

</html>