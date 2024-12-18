<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ===================== Login API ================================= //
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            // Jika login gagal
            return response()->json([
                'message' => 'Email atau password salah.'
            ], 401);
        }

        // Jika login berhasil
        // $user = Auth::user();
        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json([
        //     'message' => 'Login berhasil.',
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        //     'user' => $user,
        // ], 200);
    }

    // ===================== Logout API ================================= //
    public function logout(Request $request)
    {
        // Menghapus token yang digunakan
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil.'
        ], 200);
    }

    // ===================== Profile User API ========================== //
    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ], 200);
    }
}
