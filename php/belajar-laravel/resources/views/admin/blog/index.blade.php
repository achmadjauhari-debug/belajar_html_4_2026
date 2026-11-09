@extends('admin.layouts.app')
@section('title','Management  Blog')
@section('subtitle','Pengelompokan  Blog')

@section('content')
<div class="mb-3" align="right">
<a href="{{route('admin.blog.create')}}" class="btn-table-action">
    <i class="bi bi-person-add"></i> Tambah Blog
</a></div>    
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
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $key => $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><img src ="{{asset('storage/' . $data->cover_path ?? '')}}"></td>
                <td>{{$data->name ?? ''}}</td>
                <td>{{$data->blog_category_id ?? ''}}</td>
                <td>{{$data->slug ?? ''}}</td>
                <td>{{$data->brief_description ?? ''}}</td>
                <td>
    
                    <a class="table-btn-action" title="Edit" href="{{ route('admin.blog.edit', $data->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.blog.destroy', $data->id) }}" 
                                method="post" class="d-inline" 
                                onSubmit="return confirm('Apakah Anda Yakin?')">           
        
                            @csrf
                            @method('DELETE')
         
                    <button class="table-btn-action delete" title="Delete" type="submit"><i class="bi bi-trash">
                    </i></button>
                </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection