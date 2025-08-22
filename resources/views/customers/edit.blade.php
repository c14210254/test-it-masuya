@extends('layout')

@section('title', 'Edit Customer')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_cust.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="card">
        <h1 class="card-title">Edit Customer</h1>

        @if ($errors->any())
            <div class="popup-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_customer">Kode Customer</label>
                <input type="text" name="kode_customer" class="form-control" 
                       value="{{ old('kode_customer', $customer->kode_customer) }}" readonly>
            </div>

            <div class="form-group">
                <label for="nama_customer">Nama Customer</label>
                <input type="text" name="nama_customer" class="form-control" 
                       value="{{ old('nama_customer', $customer->nama_customer) }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat', $customer->alamat) }}</textarea>
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" class="form-control" 
                       value="{{ old('provinsi', $customer->provinsi) }}">
            </div>

            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" name="kota" class="form-control" 
                       value="{{ old('kota', $customer->kota) }}">
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control" 
                       value="{{ old('kecamatan', $customer->kecamatan) }}">
            </div>

            <div class="form-group">
                <label for="kelurahan">Kelurahan</label>
                <input type="text" name="kelurahan" class="form-control" 
                       value="{{ old('kelurahan', $customer->kelurahan) }}">
            </div>

            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" 
                       value="{{ old('kode_pos', $customer->kode_pos) }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                <a href="{{ route('customers.index') }}" class="btn btn-cancel"><i class="fa-solid fa-ban"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
