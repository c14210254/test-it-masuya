@extends('layout')

@section('title', 'Tambah Transaksi')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_trans.css') }}">
@endsection

@section('content')
<div class="container">
    <h3>Tambah Transaksi</h3>
    @if (session('error'))
        <div class="popup" id="error-popup" style="display:flex;">
            <div class="popup-content">
                <p>{{ session('error') }}</p>
                <button id="popup-close" class="btn">OK</button>
            </div>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="customer" class="form-label">Customer</label>
        <select id="customer" name="customer_id" class="form-control" required>
            <option value="">-- Pilih Customer --</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kode Customer</label>
        <input type="text" id="kode_customer" name="kode_customer" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <textarea id="alamat_customer" name="alamat_customer" class="form-control" readonly></textarea>
    </div>

        <h3>Detail Produk</h3>
        <div id="detail-container"></div>
        <div class="form-actions-button">
            <button type="button" onclick="addRow()" class="btn btn-secondary">+ Tambah Produk</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
$('#customer').change(function() {
    let customerId = $(this).val();
    if (customerId) {
        $.get("{{ url('/customers') }}/" + customerId + "/json", function(data) {
            $('#kode_customer').val(data.kode_customer);
            $('#alamat_customer').val(data.alamat);
        });
    } else {
        $('#kode_customer').val('');
        $('#alamat_customer').val('');
    }
});
</script>

<script>
let row = 0;

function addRow() {
    row++;
    let html = `
    <div class="card p-2 mb-2">
        <label>Produk</label>
        <select name="details[${row}][kode_produk]" class="form-control product-select" data-row="${row}">
            <option value="">-- Pilih Produk --</option>
            @foreach($produk as $p)
                <option value="{{ $p->kode_produk }}" data-harga="{{ $p->harga }}">{{ $p->nama_produk }}</option>
            @endforeach
        </select>
        <label>Qty</label>
        <input type="number" name="details[${row}][qty]" class="form-control" required>
        <label>Harga (optional)</label>
        <input type="number" step="0.01" name="details[${row}][harga]" class="form-control harga-input">
        <label>Disc1</label>
        <input type="number" step="0.01" name="details[${row}][disc1]" class="form-control" value="0">
        <label>Disc2</label>
        <input type="number" step="0.01" name="details[${row}][disc2]" class="form-control" value="0">
        <label>Disc3</label>
        <input type="number" step="0.01" name="details[${row}][disc3]" class="form-control" value="0">
    </div>`;
    
    document.getElementById('detail-container').insertAdjacentHTML('beforeend', html);
}

$(document).on('change', '.product-select', function() {
    let selectedOption = $(this).find('option:selected');
    let harga = selectedOption.data('harga') || '';
    $(this).closest('.card').find('.harga-input').val(harga);
});
</script>

@endsection
