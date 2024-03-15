<?php

namespace App\Http\Controllers\Api\V1\AuthApi;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            // set validation
            $validator = Validator::make($request->all(), [
                'email'     => 'required',
                'password'  => 'required'
            ]);
            // if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            // get credentials from request
            $credentials = $request->only('email', 'password');
            // if auth failed
            if (!$token = auth()->guard('api')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau Password Anda salah'
                ], 401);
            }
            // if auth success
            $user = auth()->guard('api')->user();
            // Load roles for the user
            $user->load(['role' => function ($query) {
                $query->select('id', 'name');
            }]);
            // Check if user is deleted
            if ($user->deleted_at) {
                auth()->guard('api')->logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda telah dihapus. Tidak dapat login.'
                ], 401);
            }
            return ResponseFormatter::success([
                'token_type' => 'Bearer',
                'user'    => $user,
                'token'   => $token,
            ], 'Authentication successful');
        } catch (\Exception $e) {
            return ResponseFormatter::error([
                'message' => 'Terjadi kesalahan saat memproses permintaan',
                'error'   => $e->getMessage()
            ], 'Authentication failed', 500);
        }
    }
}