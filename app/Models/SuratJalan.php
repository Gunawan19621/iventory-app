<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pabrik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratJalan extends Model
{
    use HasFactory;
    protected $table = 'surat_jalans';

    protected $fillable = [
        'surat_jalan',
        'tgl_sj',
        'id_pabrik',
        'id_user',
    ];

    public function pabrik()
    {
        return $this->belongsTo(Pabrik::class, 'id_pabrik', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}