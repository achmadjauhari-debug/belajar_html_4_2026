@extends('admin.layouts.app');
@section('title', 'Edit Kategori');
@section('subtitle', 'Perbarui Kategori Produk')

@section('content')
<form action="{{route('admin.category.update', $category->id)}}" method="post">
    @csrf
    @method('PUT')
    <form action="{{route('admin.category.store')}}" method="post">
    @csrf
    <div class="mb3">
            <label for="" class="form-label-custom">Nama Kategori</label>
            <input type="text" class="form-control" name="name" required value="{{old('name',$category->name)}}">
            @error('name')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror    
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text" class="form-control" name="slug" value="{{old('slug'),$category->slug}}">
            @error('email')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror  
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Ikon</label>
            <input type="text" class="form-control" name="icon" value="{{old('icon'),$category->icon }}">
            @error('icon')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>
    <div class="mb3">
            <label for="" class="form-label-custom">Urutan Tampil</label>
            <input type="sort_order" class="form-control" name="sort_order" value="{{old('sort_order'),$category->sort_order }}">
            @error('sort_order')
                <div class="invalid-feedback d-block">{{$message}}</div>
            @enderror 
    </div>
    <div class="mb3">
            <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
            <a href="{{url()->previous()}}" class="text-muted">Kembali</a>
    </div>
</form>
@endsection