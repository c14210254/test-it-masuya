@extends('layout')

@section('title', 'Customer')

@section('css')
<link rel="stylesheet" href="{{ asset('css/customers.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Daftar Customer</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Tambah Customer</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Provinsi</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Kode Pos</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->kode_customer }}</td>
                <td>{{ $customer->nama_customer }}</td>
                <td>{{ $customer->alamat }}</td>
                <td>{{ $customer->kota }}</td>
                <td>{{ $customer->provinsi }}</td>
                <td>{{ $customer->kecamatan }}</td>
                <td>{{ $customer->kelurahan }}</td>
                <td>{{ $customer->kode_pos }}</td>
                <td>
                    <button type="button" class="btn btn-edit" onclick="window.location='{{ route('customers.edit', $customer->id) }}'"><i class="fa-solid fa-pencil"></i></button>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-hapus trigger-delete"><i class="fa-solid fa-trash"></i></button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('customers.create') }}" class="btn btn-float" title="Tambah Customers"><i class="fa-solid fa-plus"></i></a>
</div>
<div id="delete-popup" class="popup" style="display:none;">
    <div class="popup-content">
        <p>Apakah Anda yakin ingin menghapus produk ini?</p>
        <div class="popup-actions">
            <button id="cancel-delete" class="btn btn-cancel">Batal</button>
            <button id="confirm-delete" class="btn btn-hapus">OK</button>
        </div>
    </div>
</div>

<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <button id="popup-close" class="btn">OK</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ambil pesan dari session
    @if(session('success'))
        showPopup("{{ session('success') }}");
    @elseif(session('error'))
        showPopup("{{ session('error') }}");
    @endif

    document.getElementById('popup-close').addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
    });
});

function showPopup(message) {
    document.getElementById('popup-message').textContent = message;
    document.getElementById('popup').style.display = 'flex';
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let popup = document.getElementById('delete-popup');
    let confirmBtn = document.getElementById('confirm-delete');
    let cancelBtn = document.getElementById('cancel-delete');
    let formToDelete;

    document.querySelectorAll('.trigger-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            formToDelete = this.closest('form');
            popup.style.display = 'flex';
        });
    });

    cancelBtn.addEventListener('click', function() {
        popup.style.display = 'none';
        formToDelete = null;
    });

    confirmBtn.addEventListener('click', function() {
        if(formToDelete){
            formToDelete.submit();
        }
    });
});
</script>
@endsection
