<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBatch extends Model
{
    use HasFactory;

    protected $table = 'pesanan_batch';
    protected $guarded = [];
}
