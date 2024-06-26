<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $guarded = [];

    public function menu() {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
}
