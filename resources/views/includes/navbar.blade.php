<nav class="py-3 navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Dodolan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('list.toko') }}">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
            </ul>

            <div class="d-flex ms-auto">
                <a class="px-4 btn btn-outline-primary me-2" href="{{ route('register') }}">Daftar</a>
                <a class="px-4 btn btn-primary" href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</nav>
