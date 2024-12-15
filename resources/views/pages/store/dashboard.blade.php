@extends('layouts.store')

@section('title', 'Dashboard Toko')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-center">
            <div
                class="text-center col-12 col-lg-6 text-lg-start d-flex justify-content-center justify-content-lg-start flex-column">
                <h2 style="font-size: 3.5rem; line-height: 1.2; word-break: break-word;">
                    Dashboard Toko {{ $store->store_name }}
                </h2>
                <p class="text-muted" style="font-size: 1.5rem;">{{ $store->city }}</p>
                <div class="mt-4 mb-4">
                    <a href="{{ route('store.show', $store->username) }}" class="btn btn-primary rounded-pill btn-lg"
                        style="font-size: 1.1rem;">Lihat Halaman</a>
                </div>
            </div>

            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
                <img src="{{ asset('storage/' . $store->logo) }}" alt="Store Image" class="img-fluid rounded-3">
            </div>
        </div>

        <div class="pt-4 row justify-content-between align-items-center pt-md-6">
            <div class="col-12 col-md-6 col-lg-8 d-flex flex-column align-items-start text-start">
                <h3>Statistic</h3>
            </div>
        </div>

        <div class="pt-4 row pt-md-6">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-2 stats-icon purple d-flex justify-content-center align-items-center">
                                    <i
                                        class="text-white fa-solid fa-money-check-dollar d-flex justify-content-center align-items-center fa-sm"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h6 class="font-semibold text-muted">Pendapatan</h6>
                                <h6 class="mb-0 font-extrabold">{{$store->transactions->sum('total')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-2 stats-icon blue d-flex justify-content-center align-items-center">
                                    <i
                                        class="text-white fa-solid fa-box d-flex justify-content-center align-items-center"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h6 class="font-semibold text-muted">Total Produk</h6>
                                <h6 class="mb-0 font-extrabold">{{ $store->products->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-2 stats-icon green">
                                    <i class="fa-solid fa-wallet fa-sm"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h6 class="font-semibold text-muted">Total Transaksi</h6>
                                <h6 class="mb-0 font-extrabold">{{$store->transactions->count()}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-2 stats-icon red">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h6 class="font-semibold text-muted">Total Kunjungan</h6>
                                <h6 class="mb-0 font-extrabold">{{ $store->products->sum('visitor') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-2 row align-items-center justify-content-between pt-md-6">
            <div class="col-12 col-md-6 col-lg-8">
                <h3>Manajemen Toko</h3>
            </div>
        </div>
        <section class="section">
            <ul class="py-2 nav nav-tabs" id="sectionTab" role="sectionList">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#produk" role="tab"
                        aria-controls="produk" aria-selected="true">Produk</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="promo-tab" data-bs-toggle="tab" href="#kode-promo" role="tab"
                        aria-controls="kode-promo" aria-selected="false">Kode Promo</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="transaksi-tab" data-bs-toggle="tab" href="#transaksi" role="tab"
                        aria-controls="transaksi" aria-selected="false">Transaksi</a>
                </li>
            </ul>

            <div class="mt-3 tab-content">
                <!-- Produk Section -->
                <div class="tab-pane fade show active" id="produk" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Daftar Produk</h4>
                            <a href="{{ route('store.product.create', $store->id) }}" class="btn btn-primary">Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Thumbnail</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                    alt="Thumbnail Produk" class="img-thumbnail" width="100">
                                            </td>
                                            <td>{{ $product->stock }}</td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('store.product.user.edit', [$store->id, $product->id]) }}" class="btn btn-outline-warning btn-md">Edit</a>
                                                <a href="{{ route('store.product.detail', [$store->id, $product->id]) }}" class="btn btn-outline-primary btn-md">Detail</a>

                                                <form action="{{ route('store.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-md"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Kode Promo Section -->
                <div class="tab-pane fade" id="kode-promo" role="tabpanel" aria-labelledby="promo-tab">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Daftar Kode Promo</h4>
                            <a href="{{ route('store.codes.create', $store->id) }}" class="btn btn-primary">Tambah Kode Promo</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Discount Type</th>
                                        <th>Discount Amount</th>
                                        <th>Valid Until</th>
                                        <th>Amount</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store->promoCodes as $promoCode)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $promoCode->code }}</td>
                                            <td>{{ $promoCode->discount_type }}</td>
                                            <td>Rp {{ number_format($promoCode->discount_amount, 0, ',', '.') }}</td>
                                            <td>{{ $promoCode->valid_until }}</td>
                                            <td>{{ $promoCode->amount }}</td>
                                            <td>
                                                <div class="text-end"> <a
                                                        href="{{ route('store.codes.edit', $promoCode->id) }}"
                                                        class="btn btn-outline-warning btn-md">Edit</a>

                                                    <form action="{{ route('store.codes.destroy', $promoCode->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-md"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kode promo ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Transaksi Section -->
                <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telpon</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store->transactions()->orderByDesc('created_at')->get() as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->code }}</td>
                                            <td>{{ $transaction->customer_name }}</td>
                                            <td>{{ $transaction->customer_address }}</td>
                                            <td>{{ $transaction->customer_phone }}</td>
                                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($transaction->payment_status == 'pending')
                                                    <button class="btn btn-warning btn-sm">Belum Dibayar</button>
                                                @elseif ($transaction->payment_status == 'paid')
                                                    <button class="btn btn-success btn-sm">Sudah Dibayar</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm">Gagal</button>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('store.store.transaction.detail', [$transaction->id, $store->id]) }}" class="btn btn-outline-primary btn-md">Detail</a>
                                                <a href="{{ route('store.transaction.edit', [$transaction->id, $store->id]) }}"
                                                    class="btn btn-outline-warning btn-md">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
