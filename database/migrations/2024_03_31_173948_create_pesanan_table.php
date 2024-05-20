<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pelanggan');
            $table->dateTime('tanggal')->nullable();
            $table->string('pengambilan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['PENDING', 'PROCESS', 'SHIPPING', 'DONE', 'REJECTED'])->default('PENDING');
            $table->string('catatan_pembeli')->nullable();
            $table->string('catatan_penjual')->nullable();
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
