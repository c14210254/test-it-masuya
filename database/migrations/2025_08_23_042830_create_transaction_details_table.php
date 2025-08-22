<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->string('no_inv');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->decimal('harga', 15, 2);
            $table->decimal('disc1', 5, 2)->default(0);
            $table->decimal('disc2', 5, 2)->default(0);
            $table->decimal('disc3', 5, 2)->default(0);
            $table->decimal('harga_net', 15, 2);
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksi_detail');
    }
};
