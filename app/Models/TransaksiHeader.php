<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiHeader extends Model {
    protected $table = 'transaksi_header';
    protected $fillable = [
        'no_inv','kode_customer','nama_customer','alamat_customer','tgl_inv','total'
    ];

    public function details(){
        return $this->hasMany(TransaksiDetail::class, 'no_inv', 'no_inv');

    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'kode_customer', 'kode_customer');
    }

}


