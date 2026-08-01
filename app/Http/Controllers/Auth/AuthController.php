<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Implementasi KK-01: Sistem dapat memvalidasi login pengguna (Pelayan/Koki/Kasir)
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['username' => 'Username atau password salah.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        // Redirect sesuai role (aliran 1.1 dst mengikuti dashboard masing-masing)
        return match (Auth::user()->role) {
            'Pelayan' => redirect()->route('pelayan.dashboard'),
            'Koki'    => redirect()->route('koki.dashboard'),
            'Kasir'   => redirect()->route('kasir.dashboard'),
            default   => redirect('/'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
