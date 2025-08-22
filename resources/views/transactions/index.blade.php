@extends('layout')

@section('title', 'Customer')

@section('css')
<link rel="stylesheet" href="{{ asset('css/transactions.css') }}">
@endsection

@section('content')
<div class="container">
    <h3>Daftar Transaksi</h3>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>No Cust</th>
                <th>Customer</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
            <tr>
                <td>{{ $t->no_inv }}</td>
                <td>{{ $t->kode_customer }}</td>
                <td>{{ $t->nama_customer }}</td>
                <td>{{ $t->alamat_customer }}</td>
                <td>{{ $t->tgl_inv }}</td>
                <td>Rp{{ number_format($t->total, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('transactions.show', $t->id) }}" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.create') }}" class="btn btn-float" title="Buat Transaksi">
        <i class="fa-solid fa-plus"></i>
    </a>
</div>
@endsection
