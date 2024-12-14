@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <h2 class="mb-2 text-center font-weight-bold">Dodolan</h2>
    <h3 class="mb-4 text-center">Masuk</h3>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group rounded-4">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                    placeholder="Masukan Username" name="username" required>

                @error('username')
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
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukan Password" name="password" required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary rounded-2">Masuk</button>
        </div>
        <div class="mt-3 text-center">
            <p class="text-muted">Gapunya Akun?
                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">Bikin Yuk</a>
            </p>
        </div>
    </form>
@endsection
