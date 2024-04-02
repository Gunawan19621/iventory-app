<?php

namespace App\Http\Controllers\Api\V1\ListBarangnApi;

use App\Models\ListBarang;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ListBarangApiController extends Controller
{
    public function index() 
    {
        $listBarang = ListBarang::all();

        $listBarang->load([
            'user:id,name',
            'suratJalan:id,surat_jalan,tgl_sj',
        ]);

        if($listBarang) {
            return ResponseFormatter::success([
                'result' => $listBarang
            ], 'Data list barang berhasil diambil');
            
        } else {
            return ResponseFormatter::error([
                'result' => $listBarang
            ], 'Data list barang tidak ditemukan', 404);
            
        }
    }

    public function store(Request $request)
    {
        $id_sj = $request->input('id_sj');
        $kode_barang = $request->input('kode_barang');
        $created_at = $request->input('created_at');
        $updated_at = $request->input('updated_at');

        $data = [
            'id_sj' => $id_sj,
            'kode_barang' => $kode_barang,
            'created_at' => $created_at,
        ];

        $listBarang = ListBarang::insert($data);

        if($listBarang) {
            return ResponseFormatter::success([
                'result' => $listBarang
            ], 'Data list barang berhasil ditambahkan');
            
        } else {
            return ResponseFormatter::error([
                'result' => $listBarang
            ], 'Data list barang gagal ditambahkan', 404);
            
        }
    }
}
