<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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

    public function index(Request $request)
    {
        $search = $request->search;
        $sort   = $request->sort;
        $filter = $request->filter;

        $products = Product::query();

        if ($search) {
            $products->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($filter) {
            switch ($filter) {
                case 'pc':
                case 'mini_pc':
                case 'laptop':
                case 'gaming':
                case 'hardware':
                    $products->where('kategori', $filter);
                    break;
                case 'tersedia':
                    $products->where('stok', '>', 10);
                    break;
                case 'stok_sedikit':
                    $products->whereBetween('stok', [1, 10]);
                    break;
                case 'habis':
                    $products->where('stok', 0);
                    break;
            }
        }

        if ($sort) {
            switch ($sort) {
                case 'a_z':
                    $products->orderBy('nama_produk', 'asc');
                    break;
                case 'z_a':
                    $products->orderBy('nama_produk', 'desc');
                    break;
                case 'sku_asc':
                    $products->orderBy('sku', 'asc');
                    break;
                case 'sku_desc':
                    $products->orderBy('sku', 'desc');
                    break;
                case 'harga_asc':
                    $products->orderBy('harga', 'asc');
                    break;
                case 'harga_desc':
                    $products->orderBy('harga', 'desc');
                    break;
                case 'stok_asc':
                    $products->orderBy('stok', 'asc');
                    break;
                case 'stok_desc':
                    $products->orderBy('stok', 'desc');
                    break;
            }
        } else {
            $products->latest();
        }

        $products = $products->paginate(12)->withQueryString();
        $role = $this->userRole();

        return view("{$role}.product.index", compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'sku'         => 'required|string|unique:products,sku',
            'deskripsi'   => 'nullable|string|max:1000',
            'kategori'    => 'required|string|max:100',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $index => $file) {
                if ($index >= 5) break;
                $gambarPaths[] = $file->store('products', 'public');
            }
        }
        $validated['gambar'] = json_encode($gambarPaths);

        Product::create($validated);

        $role = $this->userRole();
        return redirect()->route("{$role}.products.index")->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'sku'         => 'required|string|unique:products,sku,' . $product->id,
            'deskripsi'   => 'required|string|max:1000',
            'kategori'    => 'required|string|max:100',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPaths = json_decode($product->gambar) ?? [];

        if ($request->hasFile('gambar')) {
            foreach ($gambarPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            $gambarPaths = [];
            foreach ($request->file('gambar') as $index => $file) {
                if ($index >= 5) break;
                $gambarPaths[] = $file->store('products', 'public');
            }
        }

        $validated['gambar'] = json_encode($gambarPaths);
        $product->update($validated);

        $role = $this->userRole();
        return redirect()->route("{$role}.products.index")->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $images = json_decode($product->gambar, true) ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();

        $role = $this->userRole();
        return redirect()->route("{$role}.products.index")->with('success', 'Produk berhasil dihapus');
    }
}