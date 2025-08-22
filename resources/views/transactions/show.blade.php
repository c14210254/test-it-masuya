@extends('layout')

@section('title', 'Detail Transaksi')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail_trans.css') }}">
@endsection

@section('content')
<div class="container">
    <h3>Detail Transaksi</h3>

    <div class="transaction-info">
        <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
        <p><strong>No Invoice:</strong> {{ $transaksi->no_inv }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->tgl_inv }}</p>
        <p><strong>Customer:</strong> {{ $transaksi->customer->nama_customer }}</p>
        <p><strong>Alamat:</strong> {{ $transaksi->customer->alamat }}</p>
        <p><strong>Total:</strong> Rp{{ number_format($transaksi->total, 0, ',', '.') }}</p>
    </div>

    <h4>Produk</h4>
    <table class="table table-detail">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Disc 1</th>
                <th>Disc 2</th>
                <th>Disc 3</th>
                <th>Harga Net/Pcs</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->details as $detail)
            <tr>
                <td>{{ $detail->kode_produk }}</td>
                <td>{{ $detail->product->nama_produk }}</td>
                <td>{{ $detail->qty }}</td>
                <td>Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                <td>{{ $detail->disc1 }}</td>
                <td>{{ $detail->disc2 }}</td>
                <td>{{ $detail->disc3 }}</td>
                <td>Rp{{ number_format($detail->harga_net, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($detail->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
