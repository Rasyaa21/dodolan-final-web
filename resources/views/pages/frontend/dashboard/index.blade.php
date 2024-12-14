@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-center">
            <!-- Teks dan Tombol -->
            <div class="text-center col-12 col-lg-6 text-lg-start d-flex justify-content-center justify-content-lg-start flex-column">
                <h2 style="font-size: 3.5rem;">Toko Toko</h2>
                <p class="text-muted" style="font-size: 1.5rem;">Mie Ayam</p>
                <div class="mt-4 mb-4">
                    <button class="btn btn-primary rounded-pill btn-lg" style="font-size: 1.1rem;">View Profile</button>
                    <button class="btn btn-outline-secondary ms-2 rounded-pill btn-lg" style="font-size: 1.1rem;">Page</button>
                </div>
            </div>

            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
                <img src="{{ asset('assets/frontend/images/placeholder.jpg') }}" alt="Store Image" class="img-fluid rounded-3">
            </div>
        </div>

        <div class="pt-4 row align-items-center justify-content-between pt-md-6">
            <div class="text-center col-12 col-md-6 col-lg-8 d-flex flex-column align-items-center align-items-md-start text-md-start row">
                <h3>Product</h3>
                <h5>lorem ipsum dolor sit amettt</h5>
            </div>
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center justify-content-md-end">
                <button class="btn btn-primary me-2 rounded-pill btn-md" style="font-size: 1rem;">View More</button>
                <button class="btn btn-secondary rounded-pill btn-md" style="font-size: 1rem;">Statistic</button>
            </div>
        </div>

        <div class="pt-4 row pt-md-6">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="mb-2 stats-icon purple d-flex justify-content-center align-items-center">
                                    <i class="text-white fa-solid fa-money-check-dollar d-flex justify-content-center align-items-center fa-sm"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Pendapatan</h6>
                                <h6 class="mb-0 font-extrabold">Rp 50.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="mb-2 stats-icon blue d-flex justify-content-center align-items-center">
                                    <i class="text-white fa-solid fa-box d-flex justify-content-center align-items-center"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Total Produk</h6>
                                <h6 class="mb-0 font-extrabold">20</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="mb-2 stats-icon green">
                                    <i class="fa-solid fa-wallet fa-sm"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Total Transaksi</h6>
                                <h6 class="mb-0 font-extrabold">80.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 card-body py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="mb-2 stats-icon red">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Total Kunjungan</h6>
                                <h6 class="mb-0 font-extrabold">11.223</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-2 row align-items-center justify-content-between pt-md-6">
            <div class="col-12 col-md-6 col-lg-8">
                <h3>Daftar Produk</h3>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Produk</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Foto</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>telor</td>
                                    <td>
                                        <img src="" alt="Logo Toko" class="img-thumbnail"
                                            width="100">
                                    </td>
                                    <td>20.000</td>
                                    <td class="">Rp 80.000,00</td>
                                    <td class="text-end">
                                        <a href=""
                                            class="btn btn-outline-primary btn-md">Detail</a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

