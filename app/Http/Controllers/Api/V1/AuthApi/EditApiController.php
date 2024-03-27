<?php

namespace App\Http\Controllers\Api\V1\AuthApi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class EditApiController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
    
        $user->update($request->all()); // Menggunakan metode update() untuk mengupdate data user
    
        $userQuery = $user->load([
            'role:id,name,description', // Menggunakan metode load() untuk memuat relasi role
        ]);
    
        // Return response JSON user is updated
        if ($userQuery) {
          return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $userQuery
          ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal diupdate',
                'data' => ''
            ], 400);
        }
    }
    
}

