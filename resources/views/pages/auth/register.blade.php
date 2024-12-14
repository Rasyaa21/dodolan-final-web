@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <h2 class="mb-2 text-center font-weight-bold">Dodolan</h2>
    <h3 class="mb-4 text-center">Daftar</h3>
    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input type="text" id="username" name="username"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Masukan Username" required
                    value="{{ old('username') }}">

                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


        </div>
        <div class="mb-3">
            <label for="store_name" class="form-label">Nama Toko</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-shop"></i></span>
                <input type="text" id="store_name" name="store_name"
                    class="form-control @error('store_name') is-invalid @enderror" placeholder="Masukan Nama Toko" required
                    value="{{ old('store_name') }}">


                @error('store_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Kota Toko</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                <input type="text" id="city" name="city" class="form-control" placeholder="Masukan Kota Toko"
                    required value="{{ old('city') }}">


                @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo Toko</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                <input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror"
                    required>

                @error('logo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-shield-lock"></i></span>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary rounded-2">Daftar</button>
        </div>
        <div class="mt-3 text-center">
            <p class="text-muted">Udah Punya Akun?
                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Masuk Yuk</a>
            </p>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/register.js') }}"></script>
@endsection
