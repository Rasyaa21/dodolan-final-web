@extends('layouts.checkout')

@section('title', 'Edit Warna')

@section('content')
<section class="section">
    <div class="card" style="margin: 2rem">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Edit Warna Toko</h4>
            <a href="{{ route('store.dashboard', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('store.storeDashboard.update', request()->route('store')) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="header_color" class="form-label">Warna Header</label>
                    <input type="color" class="form-control form-control-color" id="header_color" name="header_color" value="{{ $store->header_color }}" title="Pilih warna untuk header toko">
                </div>

                <div class="mb-3">
                    <label for="primary_color" class="form-label">Warna Utama</label>
                    <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="{{ $store->primary_color }}" title="Pilih warna untuk background dan button toko">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</section>
@endsection

