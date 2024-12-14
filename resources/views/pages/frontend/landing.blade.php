@extends('layouts.app')

@section('title', 'Dodolan')

@section('content')
    <section class="hero ">
        <div class="container">
            <h1 class="hero-title">Berdayakan UMKM Bersama Dodolan</h1>
            <p class="hero-subtitle">Dodolan hadir untuk mempermudah UMKM tradisional mengelola bisnis,
                mempromosikan produk, dan meningkatkan
                penjualan. Bersama, kita wujudkan ekonomi lokal yang lebih kuat!</p>

            <div class="input-container">
                <div class="prefix">dodolan.my.id/</div>
                <input type="text" placeholder="username" class="custom-input" id="usernameInput" name="username">
                <button class="create-button items-" onclick="redirectToRegister()">Daftar</button>
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
                                class="mb-4 card-img-top">
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
                                class="mb-4 card-img-top">
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
                                class="mb-4 card-img-top">
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
                                class="mb-4 card-img-top">
                            <h5 class="card-title">Pembelian Mudah</h5>
                            <p class="card-text">Dodolan memudahkan pelanggan bertransaksi tanpa perlu login, sehingga
                                proses pembelian menjadi lebih cepat dan praktis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5" id="discover">
        <h2 class="mb-5 partner-title">
            UMKM Yang Telah Menggunakan
            <span style="color: #FFB627;">Dodolan</span>
        </h2>
        <div class="store-slider">
            <div id="storesSlide" class="stores-slide py-5">
                @foreach ($stores as $store)
                    <a href="{{ route('store.show', $store->username) }}" class="text-decoration-none">
                        <img src="{{ asset('storage/' . $store->logo) }}">
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 text-center cta-section">
        <div class="text-group">
            <h2 class="text-cat">Mulai Berjualan di Dodolan Hari Ini!</h2>
            <h2 class="text-cat">"DODOL SAIKI, UNTUNG SELAWASE"</h2>

            <div class="input-container">
                <div class="prefix">dodolan.my.id/</div>
                <input type="text" placeholder="username" class="custom-input" id="usernameInput" name="username">
                <button class="create-button items-" onclick="redirectToRegister()">Daftar</button>
            </div>
        </div>
    </section>

    <section class="testimonial-carousel" id="testimonial">
        <div class="container text-center">
            <h2 class="mb-5 partner-title">
                Testimonial Dari Penjual Yang Telah Menggunakan
                <span style="color: #FFB627;">Dodolan</span>
            </h2>
            <div id="testimonialCarousel" class="py-5 carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="mb-4 d-flex justify-content-center">
                            <div class="position-relative">
                                <div class="background-circle"></div>
                                <img src="{{ asset('assets/frontend/images/avatar/Woman Smiling Closeup.avif') }}"
                                    alt="User Image" class="testimonial-avatar">
                            </div>
                        </div>
                        <blockquote class="blockquote">
                            <p class="fs-3 fw-bold">
                                "Saya benar-benar puas menggunakan Dodolanku! Website ini sangat membantu bisnis kecil saya
                                untuk menjangkau lebih banyak pelanggan. Proses upload produk sangat mudah, dan tampilan
                                websitenya profesional. Sukses terus untuk Dodolanku!"
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Ani Rahmawati
                        </figcaption>
                    </div>
                    <div class="carousel-item">
                        <div class="mb-4 d-flex justify-content-center">
                            <div class="position-relative">
                                <div class="background-circle"></div>
                                <img src="{{ asset('assets/frontend/images/avatar/Man in Black Beanie Photo.avif') }}"
                                    alt="User Image" class="testimonial-avatar">
                            </div>
                        </div>
                        <blockquote class="blockquote">
                            <p class="fs-3 fw-bold">
                                "Dengan Dodolanku, omzet usaha saya meningkat drastis! Saya bisa mengatur toko online
                                sendiri tanpa repot. Fitur-fitur yang ditawarkan sangat lengkap, mulai dari promosi hingga
                                laporan penjualan. Highly recommended!"
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Budi Santoso
                        </figcaption>
                    </div>
                    <div class="carousel-item">
                        <div class="mb-4 d-flex justify-content-center">
                            <div class="position-relative">
                                <div class="background-circle"></div>
                                <img src="{{ asset('assets/frontend/images/avatar/Man with Necklace Avatar.avif') }}"
                                    alt="User Image" class="testimonial-avatar">
                            </div>
                        </div>
                        <blockquote class="blockquote">
                            <p class="fs-3 fw-bold">
                                "Dodolanku sangat membantu umkm saya untuk meningkatkan penjualan. Website ini sangat
                                user-friendly dan memudahkan saya dalam mengelola toko online. Terima kasih!"
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Rafi Ahmad
                        </figcaption>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <div class="mt-4 carousel-controls">
                    <button class="btn btn-outline-primary me-2" type="button" data-bs-target="#testimonialCarousel"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-outline-primary" type="button" data-bs-target="#testimonialCarousel"
                        data-bs-slide="next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
