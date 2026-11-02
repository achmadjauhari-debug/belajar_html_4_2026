@extends('admin.layouts.app')
@section('title', 'Tambah Produk')
@section('subtitle', 'Tambah Produk Baru')

@section('content')
<div class="card p-4"> {{-- Ditambahkan wrapper card agar form terlihat rapi --}}
<form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data"> {{-- enctype="multipart/form-data" digunakan untuk mengirim file gambar --}}

    @csrf 
    {{-- untuk menghindari serangan CSRF (Cross-Site Request Forgery) pada form, sehingga form hanya bisa di-submit dari halaman yang sama --}}
    <div class="mb-3">
            <label for="" class="form-label-custom">Kategori</label>
            <select class="form-control" name="category_id" required>
                <option value="">--Pilih Kategori--</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror    
    </div>
    <div class="mb-3">
            <label for="" class="form-label-custom">Nama Produk</label>
            <input type="text" class="form-control" name="name" required value="{{old('name')}}">
            @error('name')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror    
    </div>
    <div class="mb-3">
            <label for="" class="form-label-custom">Stock</label>
            <input type="number" class="form-control" name="stock" required value="{{old('stock')}}">
            @error('stock')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror  
    </div>
    <div class="mb-3">
            <label for="" class="form-label-custom">Harga</label>
            <input type="number" class="form-control" name="price" required value="{{old('price')}}">
            @error('price')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror  
    </div>
    <div class="mb-3">
            <label for="" class="form-label-custom">Gambar</label>
            <input type="file" class="form-control" name="image"> {{-- Atribut value dihapus karena tidak berlaku untuk type="file" --}}
            @error('image')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>

    <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
    </div>
</form>  
</div>
@endsection
