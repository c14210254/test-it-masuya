@extends('layout')

@section('title', 'Tambah Produk')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_prod.css') }}">
@endsection

@section('content')
    <div class="container form-container">
        <h2>Tambah Produk</h2>

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

        <form action="{{ route('products.store') }}" method="POST" class="product-form">
            @csrf
            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" value="{{ old('kode_produk') }}">
            </div>

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}">
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
            </div>

            <button type="submit" class="btn btn-submit">Simpan</button>
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
