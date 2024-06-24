<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBatch extends Model
{
    use HasFactory;

    protected $table = 'pesanan_batch';
    protected $guarded = [];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id');
    }
}
