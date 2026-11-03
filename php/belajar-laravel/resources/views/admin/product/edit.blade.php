@extends('admin.layouts.app');
@section('title', 'Edit Produk');
@section('subtitle', 'Perbarui Produk')

@section('content')
<form action="{{route('admin.product.update', $product->id)}}" method="post">
    @csrf
    @method('PUT')
    <form action="{{route('admin.product.store')}}" method="post">
    @csrf
    <div class="mb3">
            <label for="" class="form-label-custom">Kategori</label>
            <input type="text" class="form-control" name="name" required value="{{old('name',$product->category_id)}}">
            @error('name')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror    
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Nama Produk</label>
            <input type="text" class="form-control" name="product" value="{{old('product'),$product->name}}">
            @error('product')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror  
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Image</label>
            <input type="text" class="form-control" name="image" value="{{old('image'),$product->image }}">
            @error('image')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Stok</label>
            <input type="number" class="form-control" name="stock" value="{{old('stock'),$product->stock }}">
            @error('stock')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>
        <div class="mb3">
            <label for="" class="form-label-custom">Harga</label>
            <input type="number" class="form-control" name="price" value="{{old('price'),$product->price }}">
            @error('price')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>
    <div class="mb3">
            <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
            <a href="{{url()->previous()}}" class="text-muted">Kembali</a>
    </div>
</form>
@endsection