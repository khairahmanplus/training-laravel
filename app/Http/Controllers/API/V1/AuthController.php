<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $validator = validator(request()->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json([
                'errors' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'status'    => 'Successfully logout'
        ]);
    }
}
