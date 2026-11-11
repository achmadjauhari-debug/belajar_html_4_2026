@extends('admin.layouts.app')
@section('title', 'Tambah Blog Baru')
@section('subtitle', 'Tambah Blog Baru')

@section('content')
    <div class="card p-4">
        <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- NAMA BLOG --}}
                <div class="mb-3 col-sm-4">
                    <label for="" class="form-label-custom">Nama Blog</label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-4">
                    {{-- SLUG --}}
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Slug (Opsional)</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- KATEGORI --}}
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Kategori Blog</label>
                        <select class="form-control" name="blog_category_id" required>
                            <option value="">--Pilih Kategori Blog--</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}"
                                    {{ old('blog_category_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div> {{-- Penutup class="row" yang benar --}}

            {{-- DESKRIPSI SINGKAT --}}
            <div class="mb-3">
                <label class="form-label-custom">Deskripsi Singkat</label>
                <input type="hidden" name="brief_description" id="brief_description"
                    value="{{ old('brief_description') }}">
                <div id="editor-brief" style="min-height: 100px;">{!! old('brief_description') !!}</div>
            </div>

            {{-- KONTEN UTAMA BLOG --}}
            <div class="mb-3">
                <label class="form-label-custom">Konten Blog</label>
                <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                <div id="editor-content" style="min-height: 250px;">{!! old('content') !!}</div>
            </div>

            {{-- PENULIS --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Penulis</label>
                <input type="text" class="form-control" name="author" required value="{{ auth()->user()->name }}">
                @error('author')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- GAMBAR --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Gambar Cover</label>
                <input type="file" class="form-control" name="cover_path">
                @error('cover_path')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" id="btn-simpan-blog" class="btn-custom btn-custom-primary">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn-custom btn-custom-secondary">Kembali</a>
            </div>
        </form>
    </div> {{-- Penutup card p-4 diletakkan di paling bawah agar membungkus form secara utuh --}}
@endsection
