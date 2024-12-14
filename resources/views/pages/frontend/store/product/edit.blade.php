@extends('layouts.store')

@section('title', 'Edit Produk')

@section('content')
    <section class="section">
        <div class="card" style="margin: 2rem;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Edit Produk</h4>
                <a href="{{ route('store.dashboard', request()->route('store')) }}" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('store.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="store_id" value="{{ request()->route('store') }}">

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama produk" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan deskripsi produk">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="hidden" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Masukkan harga produk" value="{{ old('price', $product->price) }}">

                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="formatted_price" name="formatted_price" placeholder="Masukkan harga produk" value="{{ old('formatted_price', $product->price) }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Masukkan stok produk" value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Produk</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const toRupiah = (angka) => {
            var number_string = angka.replace(/[^,\d]/g, ''),
                split = number_string.split(/[,\.]/),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi),
                separator;

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        };

        const unformatRupiah = (rupiah) => {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        };

        const priceInput = document.getElementById('price');
        const formattedPriceInput = document.getElementById('formatted_price');

        formattedPriceInput.addEventListener('keyup', () => {
            priceInput.value = unformatRupiah(formattedPriceInput.value);
            formattedPriceInput.value = toRupiah(priceInput.value);
        });
    </script>
@endsection

