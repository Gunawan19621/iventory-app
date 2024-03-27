<?php

namespace App\Http\Controllers\Api\V1\KategoriApi;

use App\Helpers\ResponseFormatter;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriApiController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();

        if($kategori) {
            return ResponseFormatter::success([
                'result' => $kategori
            ], 'Data kategori berhasil diambil');
        } else {
            return ResponseFormatter::error([
                'result' => $kategori
            ], 'Data kategori tidak ditemukan', 404);
        }
    }
}
