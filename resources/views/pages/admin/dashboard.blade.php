@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="px-4 card-body py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="mb-2 stats-icon purple d-flex justify-content-center align-items-center">
                                        <i class="text-white fa-solid fa-store d-flex justify-content-center align-items-center fa-sm"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="font-semibold text-muted">Total Toko</h6>
                                    <h6 class="mb-0 font-extrabold">{{ $stores->count() }}</h6>
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
                                    <h6 class="mb-0 font-extrabold">1</h6>
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
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="font-semibold text-muted">Total Pelanggan</h6>
                                    <h6 class="mb-0 font-extrabold">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <div id="line">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Views</h4>
                            </div>
                            <div class="card-body">
                                <div id="bar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
