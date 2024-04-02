<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\SuratJalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListBarang extends Model
{
    use HasFactory;
    protected $table = 'list_barangs';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class, 'id_sj');
    }

    public function pabrik()
    {
        return $this->belongsTo(Pabrik::class, 'id_pabrik');
    }
}
