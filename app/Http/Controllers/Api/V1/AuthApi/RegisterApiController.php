<?php

namespace App\Http\Controllers\Api\V1\AuthApi;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
          // Set validation rules
          $validator = Validator::make($request->all(), [
            'id_role'  => 'nullable',
            'name'     => 'nullable',
            'email'    => 'nullable|email',
            'password' => 'sometimes|min:8|confirmed'
        ],
        [
            'name.required'    => 'Nama harus diisi',
            'email.required'   => 'Email harus diisi',
            'email.email'      => 'Email tidak valid',
            'password.min'     => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak cocok'
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Get authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Update user details
        $user->update($request->all());


        // Reload user with role data
        $user->load('role:id,name,description');
        
        // Return success response
        return response()->json([
            'success' => true,
            'user'    => $user,
        ], 200);
    }
}