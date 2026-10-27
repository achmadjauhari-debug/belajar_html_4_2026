@extends('belajar')
@section('content')
<form action="{{ route('actionTambah')}}" method="post">
 @csrf 
    <div class="form-group">
        <label for="">Angka 1</label>
        <input type="number" name="angka1" value="{{ $angka1 ?? '' }}" placeholder="Masukan Angka">
</div>
<br>

    <div class="form-group">
        <label for="">Angka 2</label>
        <input type="number" name="angka2" value="{{ $angka2 ?? '' }}" placeholder="Masukan Angka">
</div>
<br>
<div class="form-group">
    <button type="submit">Jumlahkan</button>
</div>
</form>

@endsection