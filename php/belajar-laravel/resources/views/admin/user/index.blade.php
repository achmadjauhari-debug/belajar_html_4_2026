@extends('admin.layouts.app')
@section('title','Management User')
@section('subtitle','Kelola akun yang memiliki akses ke dalam Admin Panel')

@section('content')
<div class="mb-3" align="right">
<a href="{{route('admin.user.create')}}" class="btn-table-action">
    <i class="bi bi-person-add"></i> Tambah User
</a></div>    
<div class="table-responsive">
    <table class="table-custom">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name ?? ''}}</td>
                <td>{{$data->email ?? ''}}</td>
                <td>
                    <a class="table-btn-action" title="Edit">
                        <i class="bi bi-trash"></i>
                    </a>    
                    <button>Delete</button>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection