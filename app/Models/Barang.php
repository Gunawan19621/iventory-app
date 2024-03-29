<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kode_kategori',
        'foto_barang',
    ];
}
