@extends('layout')

@section('title', 'Tambah Customer')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_cust.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Tambah Customer</h1>
    @if ($errors->any())
            <div class="popup" id="error-popup" style="display:flex;">
                <div class="popup-content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button id="popup-close" class="btn">OK</button>
                </div>
            </div>
        @endif
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode Customer</label>
            <input type="text" name="kode_customer" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Customer</label>
            <input type="text" name="nama_customer" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kelurahan</label>
            <input type="text" name="kelurahan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('error-popup');
        const btnClose = document.getElementById('popup-close');
        if(popup && btnClose){
            btnClose.addEventListener('click', function(){
                popup.style.display = 'none';
            });
        }
    });
</script>
@endsection
