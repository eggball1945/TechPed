<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
use Carbon\Carbon;
use illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $flashSales = FlashSale::where('is_active', true)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>', $now)
            ->get();

        return view('user.landing', compact('flashSales'));
    }
}
