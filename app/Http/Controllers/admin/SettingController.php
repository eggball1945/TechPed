<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'admin');

        $users = collect();
        $adminCount = 0;
        $petugasCount = 0;

        if ($tab === 'admin' || $tab === null || $tab === '') {
            $adminCount = DB::table('admins')->count();
            $petugasCount = DB::table('petugas')->count();

            $admins = DB::table('admins')
                ->select('id', 'username', DB::raw("'admin' as role"));

            $users = DB::table('petugas')
                ->select('id', 'username', DB::raw("'petugas' as role"))
                ->union($admins)
                ->paginate(10);
        }

        return view('admin.setting.index', compact('tab', 'users', 'adminCount', 'petugasCount'));
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username',
            'password' => 'required|string|min:6',
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.setting.index', ['tab' => 'admin'])->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function updatePetugas(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username,' . $petugas->id,
            'password' => 'nullable|string|min:6',
        ]);

        $petugas->username = $request->username;
        if ($request->filled('password')) {
            $petugas->password = $request->password;
        }
        $petugas->save();

        return redirect()->route('admin.setting.index', ['tab' => 'admin'])->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroyPetugas($id)
    {
        $petugas = \App\Models\Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.setting.index', ['tab' => 'admin'])->with('success', 'Petugas berhasil dihapus.');
    }

    public function updateUmum(Request $request)
    {
        $request->validate([
            'tax_percentage' => 'required|numeric|min:0|max:100',
        ]);

        \App\Models\SystemSetting::set('tax_percentage', $request->tax_percentage);

        return redirect()->route('admin.setting.index', ['tab' => 'umum'])->with('success', 'Pengaturan umum berhasil diperbarui.');
    }

    public function updatePembayaran(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
        ]);

        \App\Models\SystemSetting::set('bank_name', $request->bank_name);
        \App\Models\SystemSetting::set('bank_account_number', $request->bank_account_number);
        \App\Models\SystemSetting::set('bank_account_name', $request->bank_account_name);

        return redirect()->route('admin.setting.index', ['tab' => 'pembayaran'])->with('success', 'Pengaturan pembayaran berhasil diperbarui.');
    }
}
