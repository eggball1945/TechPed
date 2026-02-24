<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $carts->sum(function ($item) {
            return $item->product->harga * $item->qty;
        });

        $diskon = 0.10; // 10%
        $total = $subtotal - ($subtotal * $diskon);

        return view('cart.index', compact('carts', 'subtotal', 'total'));
    }

    public function updateQty(Cart $cart, $type)
    {
        if ($type === 'plus') {
            $cart->qty++;
        } elseif ($type === 'minus' && $cart->qty > 1) {
            $cart->qty--;
        }

        $cart->save();
        return back();
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back();
    }
}
