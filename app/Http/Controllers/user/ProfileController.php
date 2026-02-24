<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user()->load('address');
        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_depan'       => 'required|string|max:255',
            'email'            => 'required|email',
            'no_telepon'       => 'nullable|string|max:20',

            'alamat'           => 'nullable|string',
            'kota'             => 'nullable|string|max:100',
            'provinsi'         => 'nullable|string|max:100',
            'kode_pos'         => 'nullable|string|max:10',

            'password'         => 'nullable|min:8|confirmed',
            'current_password' => 'required_with:password',
        ]);

        if ($request->filled('password')) {

            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Password saat ini salah'])
                    ->withInput();
            }

            if (Hash::check($request->password, $user->password)) {
                return back()
                    ->withErrors(['password' => 'Password baru tidak boleh sama dengan password lama'])
                    ->withInput();
            }
        }

        DB::transaction(function () use ($request, $user) {

            $user->update([
                'nama_depan' => $request->nama_depan,
                'email'      => $request->email,
                'no_telepon' => $request->no_telepon,
            ]);

            if ($request->filled('alamat')) {
                $user->address()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'alamat'   => $request->alamat,
                        'kota'     => $request->kota,
                        'provinsi' => $request->provinsi,
                        'kode_pos' => $request->kode_pos,
                    ]
                );
            }

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        });

        return back()->with('success', 'Profil berhasil diperbarui');
    }

}