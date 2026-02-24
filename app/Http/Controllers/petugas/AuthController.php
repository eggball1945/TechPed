<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('petugas.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $petugas = Petugas::where('username', $request->username)->first();
        
        if ($petugas && $petugas->password === $request->password) {

            Auth::guard('petugas')->login($petugas);
            $request->session()->regenerate();

            return redirect()->route('petugas.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('petugas.auth.login');
    }
}