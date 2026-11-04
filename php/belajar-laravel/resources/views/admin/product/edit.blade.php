@extends('admin.layouts.app')
@section('title', 'Edit Produk')
@section('subtitle', 'Perbarui Produk')

@section('content')
    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_id" class="form-label-custom">Kategori</label>
            <select class="form-control" name="category_id" required>
                <option value="">--Pilih Kategori--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label-custom">Nama Produk</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label-custom">Image (Gambar Produk)</label>
            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" class="form-control" name="image">
            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label-custom">Slug</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', $product->slug) }}">
            @error('slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label-custom">Harga</label>
            <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror


            <div class="mb-3">
                <label for="price" class="form-label-custom">Harga</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="brief_description" class="form-label-custom">Deskripsi Singkat</label>
                <div id="editor-brief" style="height: 150px;">{!! old('brief_description') !!}</div>
                <input type="hidden" name="brief_description" id="brief_description">
                @error('brief_description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label-custom">Deskripsi</label>
                <div id="editor-full" style="height: 250px;">{!! old('description') !!}</div>
                <input type="hidden" name="description" id="description">
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn-custom btn-custom-secondary">Kembali</a>
            </div>
    </form>
@endsection
