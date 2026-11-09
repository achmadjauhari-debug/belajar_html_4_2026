@extends('admin.layouts.app')
@section('title', 'Tambah Kategori')
@section('subtitle', 'Tambah Blog Baru')

@section('content')
    <div class="card p-4"> {{-- Ditambahkan wrapper card agar form terlihat rapi --}}
        <form action="{{ route('admin.blog.store') }}" method="post">
            @csrf
            {{-- GAMBAR --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Gambar</label>
                <input type="file" class="form-control" name="image"> {{-- Atribut value dihapus karena tidak berlaku untuk type="file" --}}
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-6">
                {{-- KATEGORI --}}
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
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label-custom">Nama Blog</label>
                <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label-custom">Slug (Opsional)</label>
                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label-custom">Kategori Blog</label>
                <input type="text" class="form-control" name="blog_category_id" required
                    value="{{ old('blog_category_id') }}">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn-custom btn-custom-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
