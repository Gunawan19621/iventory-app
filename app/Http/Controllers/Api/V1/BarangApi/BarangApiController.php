<?php

namespace App\Http\Controllers\Api\V1\BarangApi;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        if($barangs) {
            return ResponseFormatter::success([
                'result' => $barangs
            ], 'Data barang berhasil diambil');
            
        } else {
            return ResponseFormatter::error([
                'result' => $barangs
            ], 'Data barang tidak ditemukan', 404);
        }
    }
}
