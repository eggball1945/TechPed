<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Petugas;
use App\Models\Admin;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Fetch Real Database Stats
        $productsCount = \App\Models\Product::count();
        $monthlyOrders = Order::whereMonth('tanggal', now()->month)
                             ->whereYear('tanggal', now()->year)
                             ->count();
        $activeUsers = User::count();
        $annualRevenue = Order::whereYear('tanggal', now()->year)
                              ->sum('total_harga');

        $stats = [
            'products' => $this->formatNumber($productsCount),
            'monthly_sales' => $this->formatNumber($monthlyOrders),
            'active_users' => $this->formatNumber($activeUsers),
            'annual_revenue' => $this->formatCurrency($annualRevenue)
        ];

        // Curated Staff List for About Page
        $staff = [
            [
                'name' => 'Tom Cruise',
                'role' => 'Founder & Chairman',
                'image' => 'https://m.media-amazon.com/images/M/MV5BMmU1YWU1NmMtMjAyMi00MjFiLWFmZmUtOTc1ZjI5ODkxYmQyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
                'social' => [
                    'fb' => 'https://www.facebook.com/gol.roger.798278',
                    'tw' => '#',
                    'ig' => 'https://www.instagram.com/fdball_/',
                    'li' => 'https://www.linkedin.com/in/iqbal-fadilah-94329a38a'
                ]
            ],
            [
                'name' => 'Emma Watson',
                'role' => 'Managing Director',
                'image' => 'https://www.unwomen.org/sites/default/files/2022-10/UN-Women-Goodwill-Ambassador-Emma-Watson-Credit-Celeste-Sloman-853x1280.jpg',
                'social' => [
                    'fb' => 'https://www.facebook.com/gol.roger.798278',
                    'tw' => '#',
                    'ig' => 'https://www.instagram.com/fdball_/',
                    'li' => 'https://www.linkedin.com/in/iqbal-fadilah-94329a38a'
                ]
            ],
            [
                'name' => 'Will Smith',
                'role' => 'Lead Product Designer',
                'image' => 'https://m.media-amazon.com/images/M/MV5BNTczMzk1MjU1MV5BMl5BanBnXkFtZTcwNDk2MzAyMg@@._V1_FMjpg_UX1000_.jpg',
                'social' => [
                    'fb' => 'https://www.facebook.com/gol.roger.798278',
                    'tw' => '#',
                    'ig' => 'https://www.instagram.com/fdball_/',
                    'li' => 'https://www.linkedin.com/in/iqbal-fadilah-94329a38a'
                ]
            ]
        ];

        return view('user.tentang.index', compact('stats', 'staff'));
    }

    private function formatNumber($number)
    {
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        }
        return $number;
    }

    private function formatCurrency($amount)
    {
        if ($amount >= 1000000000) {
            return round($amount / 1000000000, 1) . 'M+';
        }
        if ($amount >= 1000000) {
            return round($amount / 1000000, 1) . 'jt+';
        }
        if ($amount >= 1000) {
            return round($amount / 1000, 1) . 'rb+';
        }
        return number_format($amount, 0, ',', '.');
    }
}
