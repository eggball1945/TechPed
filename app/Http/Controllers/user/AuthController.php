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
            return redirect()->intended('/');
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

        return redirect('/');
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

        return redirect('/');
    }

    // FORGOT PASSWORD FLOW
    public function showForgotPassword()
    {
        return view('user.auth.forgot-password');
    }

    // SIMPLIFIED RESET FLOW (No Code)
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required|string',
        ]);

        $loginType = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_telepon';
        $user = User::where($loginType, $request->email_or_phone)->first();

        if (!$user) {
            return back()->withErrors(['email_or_phone' => 'Akun tidak ditemukan!']);
        }

        // Store user ID in session for identification, but skip the code logic
        session([
            'reset_user_id' => $user->id,
            'is_reset_authorized' => true
        ]);

        return redirect()->route('user.password.reset')->with('success', 'Akun ditemukan! Silakan atur sandi baru Anda.');
    }

    public function showResetPassword()
    {
        if (!session('is_reset_authorized')) {
            return redirect()->route('user.password.request');
        }
        return view('user.auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(session('reset_user_id'));
        if (!$user || !session('is_reset_authorized')) {
            return redirect()->route('user.password.request')->withErrors(['email_or_phone' => 'Gagal mereset password, silahkan coba lagi.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Clear session
        session()->forget(['reset_user_id', 'is_reset_authorized']);

        return redirect()->route('user.login')->with('success', 'Password berhasil diubah! Silahkan login.');
    }
}
