<?php

namespace App\Http\Controllers\Api\V1\AuthApi;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class EditApiController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            // Mendapatkan pengguna yang terotentikasi dari token JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token sudah kadaluarsa'
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid'
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan'
            ], 401);
        }
    
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        $userQuery = $user->with([
            'role:id,name,description',
        ])->first();
    
        // Return response JSON user is created
        if ($userQuery) {
            return response()->json([
                'success' => true,
                'user'    => $userQuery,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal diupdate'
            ], 500);
        }
    }
    
}

