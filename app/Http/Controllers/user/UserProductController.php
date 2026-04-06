<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $sort = $request->input('sort', 'terbaru');

        $products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->where('kategori', $category);
            })
            ->when($sort, function ($query) use ($sort) {
                if ($sort === 'terbaru') $query->latest();
                if ($sort === 'harga_rendah') $query->orderBy('harga', 'asc');
                if ($sort === 'harga_tinggi') $query->orderBy('harga', 'desc');
                if ($sort === 'terlaris') $query->orderByDesc('reviews_count');
            })
            ->paginate(12);

        return view('user.product.index', compact('products'));
    }

    public function terlaris()
    {
        $bestSellingProducts = Product::select('products.*', 'sales.total_sold')
            ->leftJoin(DB::raw('(
                SELECT op.product_id, SUM(op.jumlah) as total_sold 
                FROM order_product op 
                JOIN orders o ON o.id = op.order_id 
                WHERE o.status != \'dibatalkan\' 
                GROUP BY op.product_id
            ) as sales'), 'products.id', '=', 'sales.product_id')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('sales.total_sold')
            ->paginate(12);

        return view('user.product.terlaris', compact('bestSellingProducts'));
    }

    public function show($id)
    {
        $product = Product::select('products.*', 'sales.total_sold')
            ->leftJoin(DB::raw('(
                SELECT op.product_id, SUM(op.jumlah) as total_sold 
                FROM order_product op 
                JOIN orders o ON o.id = op.order_id 
                WHERE o.status != \'dibatalkan\' 
                GROUP BY op.product_id
            ) as sales'), 'products.id', '=', 'sales.product_id')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->with('reviews.user')
            ->findOrFail($id);

        $relatedProducts = Product::where('kategori', $product->kategori)
            ->where('id', '!=', $product->id)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->limit(10)
            ->get();

        return view('user.product.show', compact('product', 'relatedProducts'));
    }
}