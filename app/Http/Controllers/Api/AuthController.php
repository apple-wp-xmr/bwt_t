<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
        /**
     * Register a new user and issue a Sanctum token.
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        Auth::login($user);

        return response()->json(['status' => 'success'], 201);
    }

    /**
     * Authenticate user and return a Sanctum token.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();


        return response()->json(['status' => 'success'], 200);
    }

      /**
     * Revoke the current user token (logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
