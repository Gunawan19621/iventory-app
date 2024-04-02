<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBarang extends Model
{
    use HasFactory;
    protected $table = 'list_barangs';

    protected $fillable = [
        'id_sj',
        'kode_barang',
    ];
}