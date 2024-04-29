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
            $table->integer('id_keranjang');
            $table->integer('jumlah_tamu');
            $table->string('metode_pembayaran');
            $table->enum('status', ['belum_dikonfirmasi', 'dikonfirmasi', 'selesai', 'dibatalkan']);
            $table->string('catatan')->nullable();
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
