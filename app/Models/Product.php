<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga',
        'stok',
    ];

    public function transactionDetails(){
        return $this->hasMany(TransaksiDetail::class, 'kode_produk', 'kode_produk');
    }
}
