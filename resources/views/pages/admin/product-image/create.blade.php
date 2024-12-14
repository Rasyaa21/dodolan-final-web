@extends('layouts.admin')

@section('title', 'Edit Transaksi')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gambar Produk</h4>
            <a href="{{ route('admin.store.show', $product->store_id) }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="mb-3">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="image" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" multiple accept=".jpg, .jpeg, .png">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Gambar</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

