<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model {
    protected $table = 'transaksi_detail';
    protected $fillable = [
        'no_inv','kode_produk','nama_produk','qty','harga',
        'disc1','disc2','disc3','harga_net','jumlah'
    ];

    public function header() {
        return $this->belongsTo(TransaksiHeader::class, 'no_inv', 'no_inv');
    }

    public function transaksi() {
        return $this->belongsTo(TransaksiHeader::class, 'no_inv', 'no_inv');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'kode_produk', 'kode_produk');
    }

}
