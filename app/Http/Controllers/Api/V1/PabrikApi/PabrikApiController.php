<?php

namespace App\Http\Controllers\Api\V1\PabrikApi;

use App\Models\Pabrik;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class PabrikApiController extends Controller
{
    public function index()
    {
        $pabrik = Pabrik::all();

        if($pabrik) {
            return ResponseFormatter::success([
                'result' => $pabrik
            ], 'Data pabrik berhasil diambil');
            
        } else {
            return ResponseFormatter::error([
                'result' => $pabrik
            ], 'Data pabrik tidak ditemukan', 404);
            
        }
    }
}
