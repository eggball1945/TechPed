<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Admin;
use App\Models\Order;

    class UserController extends Controller
    {

    public function index(Request $request)
    {
        $role = $request->query('role');

        $users = User::select(
            'id',
            'nama_depan as nama',
            'email',
            'is_suspended',
            DB::raw("'user' as role"),
            DB::raw('(select count(*) from orders where users.id = orders.user_id) as orders_count'),
            DB::raw('(select sum(total_harga) from orders where users.id = orders.user_id) as orders_sum')
        );

        $petugas = Petugas::select(
            'id',
            'username as nama',
            DB::raw('NULL as email'),
            DB::raw('NULL as is_suspended'),
            DB::raw("'petugas' as role"),
            DB::raw('NULL as orders_count'),
            DB::raw('NULL as orders_sum')
        );

        $admins = Admin::select(
            'id',
            'username as nama',
            DB::raw('NULL as email'),
            DB::raw('NULL as is_suspended'),
            DB::raw("'admin' as role"),
            DB::raw('NULL as orders_count'),
            DB::raw('NULL as orders_sum')
        );

        if ($role === 'user') {
            $query = $users;
        } elseif ($role === 'petugas') {
            $query = $petugas;
        } elseif ($role === 'admin') {
            $query = $admins;
        } else {
            $query = $users
                ->unionAll($petugas)
                ->unionAll($admins);
        }

        $items = DB::query()
            ->fromSub($query, 'data')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('items'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:6'
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.users.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:petugas,username,' . $petugas->id,
            'password' => 'nullable|min:6'
        ]);

        $data = [
            'username' => $request->username
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    public function destroyPetugas(Petugas $petugas)
    {
        $petugas->delete();

        return back()->with('success', 'Petugas berhasil dihapus');
    }

    public function toggleSuspend($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_suspended' => !$user->is_suspended
        ]);

        return back()->with('success', 'Status user berhasil diubah');
    }
}