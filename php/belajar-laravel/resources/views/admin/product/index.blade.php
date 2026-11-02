@extends('admin.layouts.app')
@section('title', 'Management Produk')
@section('subtitle', 'Pengelompokan produk')

@section('content')
    <div align="right" class="mb-3">
        <a href="{{ route('admin.product.create') }}" class="btn-table-action">
            <i class="bi bi-person-add"></i> Tambah Produk
        </a>
    </div>
    <div class="table-responsive mt-1">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Image</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data produk akan ditampilkan di sini -->
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" width="100">
                            @else
                                <p>No Image Available</p>
                            @endif
                        </td>
                        <td>{{ $item->stock }}</td>
                        <td>Rp. {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>
                            <a class="table-btn-action" title="Edit" href="{{ route('admin.product.edit', $item->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.product.destroy', $item->id) }}" method="post" class="d-inline"
                                onSubmit="return confirm('Apakah Anda Yakin?')">

                                @csrf
                                @method('DELETE')

                                <button class="table-btn-action delete" title="Delete" type="submit"><i
                                        class="bi bi-trash">
                                    </i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
