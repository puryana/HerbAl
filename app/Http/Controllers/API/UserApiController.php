<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function loginWithUID(Request $request)
{
    
    $validated = $request->validate([
        'uid' => 'required|string',
        'name' => 'nullable|string',
        'email' => 'nullable|email',
    ]);

    $user = User::where('uid', $validated['uid'])->first();

    if (!$user) {
        $user = User::create([
            'uid' => $validated['uid'],
            'name' => $validated['name'] ?? 'Anonymous',
            'email' => $validated['email'] ?? null,
            'password' => bcrypt('firebase_default'),
        ]);
    }

    $token = $user->createToken('flutter_app')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Login berhasil',
        'data' => [
            'user' => $user,
            'token' => $token,
        ],
    ]);
}

}
