<?php

namespace App\Http\Controllers\Api\V1\SuratJalanApi;

use App\Models\SuratJalan;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ListBarang;
use Illuminate\Support\Facades\DB;

class SuratJalanApiController extends Controller
{
    public function index() 
    {
        $suratJalan = SuratJalan::get();

        $suratJalan->load([
            'user:id,name',
            'pabrik:id,nama_pabrik',
            
        ]);

        if($suratJalan) {
            return ResponseFormatter::success([
                'result' => $suratJalan
            ], 'Data surat jalan berhasil diambil');
            
        } else {
            return ResponseFormatter::error([
                'result' => $suratJalan
            ], 'Data surat jalan tidak ditemukan', 404);
            
        }
    }


    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $mobile_id_sj = $request->input('mobile_id_sj');
            $surat_jalan = $request->input('surat_jalan');
            $tgl_sj = $request->input('tgl_sj');
            $id_pabrik = $request->input('id_pabrik');
            $id_user = $request->input('id_user');
            
        $created_at = $request->input('created_at');
        $updated_at = $request->input('updated_at');

            $data = [
                'mobile_id_sj' => $mobile_id_sj,
                'surat_jalan' => $surat_jalan,
                'tgl_sj' => $tgl_sj,
                'id_pabrik' => $id_pabrik,
                'id_user' => $id_user,
                'created_at' => $created_at,
            ];

            $suratJalan = SuratJalan::insert($data);
            
            DB::commit();

            return ResponseFormatter::success([
                'message' => 'Data surat jalan berhasil ditambahkan',
                'result' => $suratJalan
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error([
                'message' => 'Data surat jalan gagal ditambahkan',
                'error' => $e
            ], 'Data surat jalan gagal ditambahkan', 500);
        }
    }
    

}
