<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * api login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // return validation error
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validate->errors(),
            ], 403);
        }

        $userEmail = $request->get('email');
        $userPassword = $request->get('password');

        // check email exist
        $user = User::where('email', $userEmail)->first();

        // check password
        if(!$user || !Hash::check($userPassword, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // prepare response
        $data['token'] = $user->createToken($userEmail)->plainTextToken;
        $data['user'] = $user;

        $response = [
            'success' => true,
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * api logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // delete tokens
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'User is logged out successfully'
        ]);
    }
}
