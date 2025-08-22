<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_customer',
        'nama_customer',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
    ];

    public function transactionDetails(){
        return $this->hasMany(TransaksiHeader::class, 'kode_customer', 'kode_customer');
    }
}
