@extends('layouts.admin')

@section('title', 'Daftar Kode Promo')


@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Kode Promo</h4>
                <a href="{{ route('admin.promo.create', request()->route('store')) }}" class="btn btn-primary">Tambah Kode Promo</a>
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
                        @foreach ($codes as $code)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $code->code }}</td>
                                <td>{{ $code->discount_type }}</td>
                                <td>{{ $code->discount_amount }}</td>
                                <td>{{ $code->valid_until }}</td>
                                <td>{{ $code->amount }}</td>
                                <td>
                                    <div class="text-end">  <a href="{{ route('admin.promo.edit', $store_id) }}"
                                            class="btn btn-outline-warning btn-md">Edit</a>

                                        <form action="{{ route('admin.promo.destroy', $store_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-md"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
