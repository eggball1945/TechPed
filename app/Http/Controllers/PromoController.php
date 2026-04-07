<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    private function userRole()
    {
        if (auth('admin')->check()) {
            return 'admin';
        }

        if (auth('petugas')->check()) {
            return 'petugas';
        }

        abort(403);
    }

    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        $role = $this->userRole();
        return view("{$role}.promo.index", compact('promos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'end_date' => 'required|date',
        ]);

        Promo::create($validated);
        $role = $this->userRole();
        return redirect()->route("{$role}.promo.index")->with('success', 'Promo berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'end_date' => 'required|date',
        ]);

        $promo->update($validated);
        $role = $this->userRole();
        return redirect()->route("{$role}.promo.index")->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        $role = $this->userRole();
        return redirect()->route("{$role}.promo.index")->with('success', 'Promo berhasil dihapus');
    }
}
