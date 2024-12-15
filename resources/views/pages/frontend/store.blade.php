@extends('layouts.app')

@section('title', 'Dodolan')

@section('content')
<section style="background: linear-gradient(135deg, #ffa07a, #FF9900); min-height: 100vh; width: 100%; margin: 0; padding: 0;">
    <section class="py-5 store">
        <h1 class="text-center store-title">List Toko</h1>
        <div class="mt-4 store-search-container justify-content-center align-items-center">
            <form action="{{ route('list.toko') }}" method="GET" class="d-flex justify-content-center">
                <input
                    type="text"
                    name="store_name"
                    class="custom-input-toko"
                    placeholder="Cari toko berdasarkan nama..."
                    value="{{ request('store_name') }}">
                <button type="submit" style="display: none;"></button>
            </form>
        </div>
        <section class="container">
            <div class="container">
                <div class="mt-5 row">
                    @foreach ($stores as $store)
                        <div class="mb-3 col-6 col-lg-3 col-md-6">
                            <a class="card card-product"
                                href="{{ route('store.show', $store->username) }}">
                                <img src="{{ asset('storage/' . $store->logo) }}" alt="image" class="card-img-top">
                                <h5 class="card-title">{{ $store->store_name }}</h5>
                                <p class="card-text">{{ $store-> city}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </section>
</section>
@endsection
