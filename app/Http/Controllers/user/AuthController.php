<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan login pakai email atau no telepon
        $loginType = filter_var(
            $credentials['email_or_phone'],
            FILTER_VALIDATE_EMAIL
        ) ? 'email' : 'no_telepon';

        if (Auth::guard('web')->attempt([
            $loginType => $credentials['email_or_phone'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/landing');
        }

        return back()->withErrors([
            'email_or_phone' => 'Email / No Telepon atau password salah!',
        ])->onlyInput('email_or_phone');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing');
    }

    public function showRegister()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'nullable|string|unique:users,no_telepon',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);

        return redirect('/landing');
    }
}
