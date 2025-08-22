@extends('layout')

@section('title', 'Edit Produk')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_prod.css') }}">
@endsection

@section('content')
    <div class="container form-container">
        <h2>Edit Produk</h2>

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

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="product-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_produk">Kode Produk</label>
                <input type="text" value="{{ $product->kode_produk }}" class="form-control" disabled>
            </div>

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" value="{{ $product->harga }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" value="{{ $product->stok }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-submit">Update</button>
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

