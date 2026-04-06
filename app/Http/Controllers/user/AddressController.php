<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses; // relasi harus didefinisikan di model User
        return view('user.profile.addresses', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
        ]);

        UserAddress::create([
            'user_id' => Auth::id(),
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return back()->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    public function update(Request $request, UserAddress $alamat)
    {
        // Pastikan alamat milik user yang sedang login
        if ($alamat->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'alamat' => 'required|string',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
        ]);

        $alamat->update($request->only('alamat', 'kota', 'provinsi', 'kode_pos'));

        return back()->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(UserAddress $alamat)
    {
        if ($alamat->user_id !== Auth::id()) {
            abort(403);
        }

        $alamat->delete();
        return back()->with('success', 'Alamat berhasil dihapus.');
    }
}