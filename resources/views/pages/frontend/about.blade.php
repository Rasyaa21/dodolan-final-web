@extends('layouts.app')

@section('title', 'Dodolan')

@section('content')
<section class="py-5 about-app" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row align-items-center">
            <div class="mb-4 text-center col-md-6 text-md-start mb-md-0">
                <h2 class="mb-4 section-title">Dodolan</h2>
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



<!-- Section 2: Kegunaan Aplikasi -->
<section class="py-5 about-usage" style="background-color: #fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center col-md-8">
                <h2 class="mb-4 section-title">Kegunaan Aplikasi</h2>
                <p class="section-description">
                    Aplikasi ini membantu pemilik UMKM dalam:
                </p>
                <ul class="mx-auto list-unstyled text-start" style="max-width: 600px;">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mengelola stok produk dengan mudah.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mempromosikan produk secara online.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Menjangkau pelanggan lebih luas.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Meningkatkan penjualan dan pendapatan.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5 team-section" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row gy-5 justify-content-center align-items-start">
            <!-- Developer 1 -->
            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile1.jpg') }}"
                        alt="Developer 1"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">Muhammad Faisal</h4>
                <p class="member-role text-muted">Web Developer</p>
            </div>

            <!-- Developer 2 -->
            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile2.jpg') }}"
                        alt="Developer 2"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">Ahmad Rasyid</h4>
                <p class="member-role text-muted">UI/UX Designer</p>
            </div>

            <!-- Developer 3 -->
            <div class="text-center col-md-4">
                <img src="{{ asset('assets/frontend/images/team/profile3.jpg') }}"
                        alt="Developer 3"
                        class="mb-3 team-photo img-fluid rounded-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mb-1 member-name">Siti Aisyah</h4>
                <p class="member-role text-muted">Frontend Developer</p>
            </div>
        </div>
    </div>
</section>


<!-- Section 4: Footer -->
<footer class="mt-4 footer-section">
    <hr>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <ul class="py-2 list-unstyled">
                    <li><a href="/home" class="text-decoration-none text-dark" style="margin-bottom: 1rem;">Home</a></li>
                    <li><a href="/about" class="text-decoration-none text-dark" style="margin-bottom: 1rem;">About</a></li>
                    <li><a href="/blog" class="text-decoration-none text-dark" style="margin-bottom: 1rem;">Blog</a></li>
                    <li><a href="/store" class="text-decoration-none text-dark" style="margin-bottom: 1rem;">Store</a></li>
                </ul>
                <ul class="list-inline">
                    <li class="mx-2 list-inline-item">
                        <a href="https://facebook.com" class="text-decoration-none text-dark">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </li>
                    <li class="mx-2 list-inline-item">
                        <a href="https://twitter.com" class="text-decoration-none text-dark">
                            <i class="bi bi-twitter"></i>
                        </a>
                    </li>
                    <li class="mx-2 list-inline-item">
                        <a href="https://instagram.com" class="text-decoration-none text-dark">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5 class="mb-3 email-text">Send Us an Email</h5>
                <form action="#" method="POST">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control" rows="3" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send</button>
                </form>
            </div>
        </div>
    </div>
    <div class="py-4 text-center footer-box">
        <p class="mb-0 text-muted">&copy; 2024 Dodolan. All rights reserved.</p>
    </div>
</footer>
@endsection
