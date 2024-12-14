@extends('layouts.admin')

@section('title', 'Tambah Toko')


@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Tambah Toko</h4>
                <a href="{{ route('admin.store.index') }}" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username Toko</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" placeholder="Masukkan Username Toko" value="{{ old('username') }}">

                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Toko</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Masukkan Password Toko">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="store_name" class="form-label">Nama Toko</label>
                        <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name"
                            name="store_name" placeholder="Masukkan Nama Toko" value="{{ old('store_name') }}">

                        @error('store_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Toko</label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                            name="logo">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            name="city" placeholder="Masukkan Kota" value="{{ old('city') }}">
                        @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Toko</button>
                </form>
            </div>
        </div>
    </section>
@endsection
