@extends('admin.layouts.app')
@section('title', 'Management Blog')
@section('subtitle', 'Pengelompokan Blog')

@section('content')
    <div class="mb-3" align="right">
        <a href="{{ route('admin.blog.create') }}" class="btn-table-action">
            <i class="bi bi-person-add"></i> Tambah Blog
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Slug Url</th>
                    <th>Deskripsi Singkat</th>
                    <th>Isi Blog</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $key => $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($data->cover_path)
                                <img src ="{{ asset('storage/' . $data->cover_path ?? '') }}" alt="Cover"
                                    class="img-thumbnail" style="width:80px;max-height:80px;object-fit:cover;">
                            @else
                                <span class="text-muted small">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $data->name ?? '' }}</td>
                        <td>{{ $data->category->name ?? '' }}</td>
                        <td>{{ $data->slug ?? '' }}</td>

                        {{-- DESKRIPSI SINGKAT (DIPOTONG + TOMBOL MODAL) --}}
                        <td>{{ Str::limit(strip_tags($data->brief_description ?? ''), 30) }}
                            @if (strlen(strip_tags($data->brief_description)) > 30)
                                <a href="#" class="text-primary text-decoration-none fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalBrief{{ $data->id }}">more</a>
                            @endif
                        </td>


                        {{-- ISI BLOG / KONTEN (DIPOTONG + TOMBOL MODAL) --}}
                        <td>
                            {{ Str::limit(strip_tags($data->content ?? ''), 30) }}
                            @if (strlen(strip_tags($data->content)) > 30)
                                <a href="#" class="text-primary text-decoration-none fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalContent{{ $data->id }}">more</a>
                            @endif
                        </td>


                        <td>{{ strip_tags($data->author ?? '') }}</td>

                        <td>

                            <a class="table-btn-action" title="Edit" href="{{ route('admin.blog.edit', $data->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.blog.destroy', $data->id) }}" method="post" class="d-inline"
                                onSubmit="return confirm('Apakah Anda Yakin?')">

                                @csrf
                                @method('DELETE')

                                <button class="table-btn-action delete" title="Delete" type="submit"><i
                                        class="bi bi-trash">
                                    </i></button>
                            </form>
                        </td>
                    </tr>
                    {{-- ========================================================
     START: KOMPONEN MODAL POP-UP (Ditaruh di dalam loop @foreach)
     ======================================================== --}}
                    <!-- Modal untuk Deskripsi Singkat -->
                    <div class="modal fade" id="modalBrief{{ $data->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Deskripsi Singkat: {{ $data->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $data->brief_description !!} {{-- Menggunakan {!! !!} agar format teks Quill tetap muncul indah --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal untuk Isi Konten Utama Blog -->
                    <div class="modal fade" id="modalContent{{ $data->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Isi Lengkap Blog: {{ $data->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $data->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ========================================================
                        END: KOMPONEN MODAL POP-UP
                    ======================================================== --}}
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
