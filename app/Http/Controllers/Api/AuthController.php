<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $credentials['username'] = $request->input('username');

            $credentials['password'] = $request->input('password');

            if (!Auth::attempt($credentials)) {

                return response()->json([

                    'status' => 401,

                    'message' => 'Unauthorized'

                ], 401)->header('Content-Type', 'application/json');

            }

            $user = User::where('username', $credentials['username'])->first();

            if (!Hash::check($credentials['password'], $user->password, [])) {

                throw new \Exception('Exception in login');

            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;


            if (!$user->active) {
                return response()->json([

                    'status' => 401,

                    'message' => 'Unauthorized, Agent account is suspended, please contact your administrator'

                ], 401)->header('Content-Type', 'application/json');

            }

            return response()->json([

                'status' => 200,

                'access_token' => $tokenResult,

                'user' => $user

            ], 200)->header('Content-Type', 'application/json');

        } catch (\Exception $error) {

            return response()->json([

                'status' => 500,

                'message' => 'Exception in Login',

                'error' => $error,

            ], 500)->header('Content-Type', 'application/json');

        }
    }
}
