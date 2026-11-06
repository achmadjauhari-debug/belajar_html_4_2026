@extends('admin.layouts.app')
@section('title', 'Tambah Produk')
@section('subtitle', 'Tambah Produk Baru di PPKD Sticker')

@section('content')
    <div class="card p-4"> {{-- Ditambahkan wrapper card agar form terlihat rapi --}}
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data"> {{-- enctype="multipart/form-data" digunakan untuk mengirim file gambar --}}

            @csrf
            {{-- untuk menghindari serangan CSRF (Cross-Site Request Forgery) pada form, sehingga form hanya bisa di-submit dari halaman yang sama --}}
            {{-- NAMA PRODUK --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Nama Produk</label>
                <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-sm-6">
                    {{-- SLUG --}}
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Slug(Optional)</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
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
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Deskripsi Singkat</label>
                <div id="editor-brief" style="height: 150px;">{!! old('brief_description') !!}</div>
                <input type="hidden" name="brief_description" id="brief_description">
                @error('brief_description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="" class="form-label-custom">Deskripsi</label>
                <div id="editor-full" style="height: 250px;">{!! old('description') !!}</div>
                <input type="hidden" name="description" id="description">
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- HARGA --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga</label>
                        <input type="number" class="form-control" name="price" required value="{{ old('price') }}">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Art Cartoon</label>
                        <input type="number" class="form-control" name="price_art_cartoon"
                            value="{{ old('price_art_cartoon') }}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Art Paper</label>
                        <input type="number" class="form-control" name="price_art_paper"
                            value="{{ old('price_art_paper') }}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga HVS</label>
                        <input type="number" class="form-control" name="price_hvs" value="{{ old('price_hvs') }}">
                    </div>
                </div>

            </div>

            {{-- HARGA LAMINATING --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Laminating Doft</label>
                        <input type="number" class="form-control" name="price_doft" value="{{ old('price_doft') }}">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Laminating Glossy</label>
                        <input type="number" class="form-control" name="price_glossy" value="{{ old('price_glossy') }}">
                    </div>
                </div>

            </div>
            {{-- HARGA POTONG --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Potong (Min 5x5 cm)</label>
                        <input type="number" class="form-control" name="price_cutting"
                            value="{{ old('price_cutting') }}">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label for="" class="form-label-custom">Harga Tanpa Potong</label>
                        <input type="number" class="form-control" name="price_no_cutting"
                            value="{{ old('price_no_cutting') }}">
                    </div>
                </div>

            </div>
    </div>

    {{-- GAMBAR --}}
    <div class="mb-3">
        <label for="" class="form-label-custom">Gambar</label>
        <input type="file" class="form-control" name="image"> {{-- Atribut value dihapus karena tidak berlaku untuk type="file" --}}
        @error('image')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- BUTTON --}}
    <div class="mb-3">
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn-custom btn-custom-secondary">Kembali</a>
    </div>
    </form>
    </div>
@endsection
