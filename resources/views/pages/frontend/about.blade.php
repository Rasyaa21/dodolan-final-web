@extends('layouts.app')

@section('title', 'Dodolan')

@section('content')
<section class="about-app" style="background: linear-gradient(135deg, #FFE5D9, #E5F0FF); padding: 8rem">
    <div class="container">
        <div class="row align-items-center">
            <div class="mb-4 text-center col-md-6 text-md-start mb-md-0">
                <h2 class="mb-4 team-title">Dodolan</h2>
                <p class="section-description">
                    Dodolan adalah platform e-commerce berbasis web yang dirancang untuk memudahkan UMKM dalam menciptakan toko online secara instan tanpa memerlukan proses login atau keahlian teknis. Dengan berbagai fitur inovatif seperti pembuatan toko instan, checkout tanpa akun, dan subsidi ongkos kirim, platform ini bertujuan untuk membantu UMKM masuk ke dunia digital secara efisien.
                </p>
            </div>
            <div class="text-center text-lg-end col-md-6">
                <img src="https://via.placeholder.com/400x300" alt="Ilustrasi Dodolan" class="rounded img-fluid custom-img">
            </div>
        </div>
    </div>
</section>



<section class="py-5 features" id="fitur">
    <div class="container">
        <h2 class="features-title">Fitur Utama</h2>

        <div class="mt-3 row">
            <div class="mb-3 col-12 col-md-6 col-lg-3">
                <div class="border-0 shadow-sm card card-feature">
                    <div class="text-center card-body">
                        <img src="{{ asset('assets/frontend/images/features/product-management.png') }}" alt="Feature 1"
                            class="card-img-top">
                        <h5 class="card-title">Manajemen</h5>
                        <p class="card-text">Dodolan menyediakan fitur manajemen produk untuk memudahkan UMKM dalam
                            mengelola produk mereka.</p>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-12 col-md-6 col-lg-3">
                <div class="border-0 shadow-sm card card-feature">
                    <div class="text-center card-body">
                        <img src="{{ asset('assets/frontend/images/features/role-pengguna.png') }}" alt="Feature 1"
                            class="card-img-top">
                        <h5 class="card-title">User Friendly</h5>
                        <p class="card-text">Dodolan dirancang sederhana dan intuitif, memudahkan pemilik UMKM
                            tradisional yang kurang akrab teknologi.</p>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-12 col-md-6 col-lg-3">
                <div class="border-0 shadow-sm card card-feature">
                    <div class="text-center card-body">
                        <img src="{{ asset('assets/frontend/images/features/laporan-penjualan.png') }}" alt="Feature 1"
                            class="card-img-top">
                        <h5 class="card-title">Laporan Penjualan</h5>
                        <p class="card-text">Dodolan menyediakan fitur laporan penjualan yang membantu UMKM menganalisis
                            performa penjualan mereka dengan data yang terstruktur dan mudah dipahami.</p>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-12 col-md-6 col-lg-3">
                <div class="border-0 shadow-sm card card-feature">
                    <div class="text-center card-body">
                        <img src="{{ asset('assets/frontend/images/features/pembelian.png') }}" alt="Feature 1"
                            class="card-img-top">
                        <h5 class="card-title">Pembelian Mudah</h5>
                        <p class="card-text">Dodolan memudahkan pelanggan bertransaksi tanpa perlu login, sehingga
                            proses pembelian menjadi lebih cepat dan praktis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-section" style="background: linear-gradient(135deg, #FFE5D9, #E5F0FF); padding: 8rem">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="team-title" style="margin-bottom: 2rem">Our Team</h2>
        </div>
        <div class="row gy-5 justify-content-center align-items-start">
            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile1.jpg') }}"
                        alt="Developer 1"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">Naufal Qathafa Rasya Hidayat</h4>
                <p class="member-role text-muted">Web Developer</p>
            </div>

            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile2.jpg') }}"
                        alt="Developer 2"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">farrel Dwi Lasso</h4>
                <p class="member-role text-muted">UI/UX Designer</p>
            </div>

            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile3.jpg') }}"
                        alt="Developer 3"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">Fabiansky Trafada Perkasa</h4>
                <p class="member-role text-muted">Frontend Developer</p>
            </div>
        </div>
    </div>
</section>

<footer class="mt-4 footer-section">
    <hr>
    <div class="container" style="padding: 4rem">
        <div class="row justify-content-center">
            <div class="text-center col-12 col-md-6">
                <ul class="py-2 list-unstyled d-flex flex-column flex-md-row justify-content-center align-items-center navigation-links">
                    <li class="mb-3 mb-md-0 mx-md-3">
                        <a href="{{ route('landing') }}" class="text-decoration-none text-dark link-item">Home</a>
                    </li>
                    <li class="mb-3 mb-md-0 mx-md-3">
                        <a href="{{ route('list.toko') }}" class="text-decoration-none text-dark link-item">Store</a>
                    </li>
                    <li class="mb-3 mb-md-0 mx-md-3">
                        <a href="{{ route('about') }}" class="text-decoration-none text-dark link-item">About</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-4 row justify-content-center">
            <div class="text-center col-12 col-md-6">
                <ul class="list-inline d-flex flex-column flex-md-row justify-content-center align-items-center social-icons">
                    <li class="mb-3 mb-md-0 mx-md-3 list-inline-item">
                        <a href="https://facebook.com" class="text-decoration-none text-dark icon-item" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="mb-3 mb-md-0 mx-md-3 list-inline-item">
                        <a href="https://twitter.com" class="text-decoration-none text-dark icon-item" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="mb-3 mb-md-0 mx-md-3 list-inline-item">
                        <a href="https://instagram.com" class="text-decoration-none text-dark icon-item" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-4 text-center footer-box">
        <p class="mb-0 text-muted">&copy; 2024 Dodolan. All rights reserved.</p>
    </div>
</footer>

<script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>



@endsection
