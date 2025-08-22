<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksi_header', function (Blueprint $table) {
            $table->id();
            $table->string('no_inv')->unique();
            $table->string('kode_customer');
            $table->string('nama_customer');
            $table->text('alamat_customer')->nullable();
            $table->date('tgl_inv');
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksi_header');
    }
};
