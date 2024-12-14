@extends('layouts.admin')

@section('title', 'Daftar Toko')


@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Toko</h4>
                <a href="{{ route('admin.store.create') }}" class="btn btn-primary">Tambah Toko</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Toko</th>
                            <th>Logo Toko</th>
                            <th>Kota</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $store->username }}</td>
                                <td>{{ $store->store_name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo Toko" class="img-thumbnail"
                                        width="100">
                                </td>
                                <td>{{ $store->city }}</td>
                                <td>
                                    <div class="text-end">  <a href="{{ route('admin.store.edit', $store->id) }}"
                                            class="btn btn-outline-warning btn-md">Edit</a>

                                        <a href="{{ route('admin.store.show', $store->id) }}"
                                            class="btn btn-outline-info btn-md">Detail</a>

                                        <form action="{{ route('admin.store.destroy', $store->id) }}" method="POST"
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
