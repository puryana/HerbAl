<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminherbal_controller extends Controller
{
     // ===================== Halaman Login ================================ //
    public function index()
    {
        return view('admin.login');
    }

    // ===================== Proses Halaman Login ============================= //
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Redirect ke halaman dashboard jika login berhasil
            return redirect()->route('admin.home');
        }

        // Jika login gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
    
     // =============== Menampilkan halaman index =========================== //
    public function indexDashboard()
    {
        // Pastikan admin sudah login
        if (Auth::check()) {
            return view('admin.index');
        }

        // Jika tidak login, redirect ke halaman login
        return redirect()->route('login');
    }

     // ================= Menampilkan konten dashboard ====================== //
    public function dashboard()
    {
        return view('admin.dashboard');
    }


     // ===================== Logout admin ================================= //
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
