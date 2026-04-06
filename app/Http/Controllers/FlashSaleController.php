<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlashSaleController extends Controller
{
    public function index()
    {
        // 5 produk acak untuk rekomendasi (dengan rating dan ulasan)
        $randomProducts = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->take(5)
            ->get();

        // 4 produk terlaris (berdasarkan total penjualan)
        $bestProducts = Product::select('products.*', 'sales.total_sold')
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
            ->take(8) // increase taken products so more items have a chance to show up on terlaris UI
            ->get();

        $newProducts = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->take(4)
            ->get();

        if ($newProducts->count() < 4) {
            $needed = 4 - $newProducts->count();
            $additional = Product::where('is_new', false)
                ->latest()
                ->take($needed)
                ->get();
            $newProducts = $newProducts->concat($additional);
        }

        $pcProduct = Product::where('kategori', 'PC')->first();

        $hardwareProduct = Product::where('kategori', 'Hardware')
            ->inRandomOrder()
            ->first();

        $promo = Promo::where('name', 'hardware_promo')->first();
        if ($promo && $promo->end_date) {
            $promoEndDate = $promo->end_date->format('Y-m-d H:i:s');
        } else {
            $promoEndDate = now()->addDays(7)->format('Y-m-d H:i:s');
            Promo::updateOrCreate(
                ['name' => 'hardware_promo'],
                ['end_date' => $promoEndDate]
            );
        }

        return view('user.layouts.home', compact(
            'randomProducts',
            'bestProducts',
            'newProducts',
            'pcProduct',
            'hardwareProduct',
            'promoEndDate'
        ));
    }
}