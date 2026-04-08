<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])
            ->latest()
            ->paginate(10);

        if (auth('admin')->check()) {
            return view('admin.reviews.index', compact('reviews'));
        }

        if (auth('petugas')->check()) {
            return view('petugas.reviews.index', compact('reviews'));
        }

        abort(403);
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'komentar'   => 'nullable|string',
            'show_name'  => 'nullable',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ensure the order belongs to the authenticated user and is shipped or completed (final status)
        $order = Order::where('user_id', Auth::id())
            ->whereIn('status', ['dikirim', 'selesai'])
            ->findOrFail($request->order_id);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('reviews', 'public');
        }

        $review = Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
            'order_id'   => $request->order_id,
            'rating'     => $request->rating,
            'komentar'   => $request->komentar,
            'show_name'  => $request->has('show_name') ? filter_var($request->show_name, FILTER_VALIDATE_BOOLEAN) : true,
            'gambar'     => $gambarPath,
        ]);

        return response()->json([
            'success' => true,
            'review'  => $review,
            'message' => 'Ulasan berhasil ditambahkan.'
        ]);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Check if the authenticated user is the owner, or if admin/petugas is logged in
        $isOwner = Auth::check() && Auth::id() === $review->user_id;
        $isAdmin = auth('admin')->check();
        $isPetugas = auth('petugas')->check();

        if (!$isOwner && !$isAdmin && !$isPetugas) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus ulasan ini.');
        }

        $review->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus.'
            ]);
        }

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    public function destroyAll()
    {
        $isAdmin = auth('admin')->check();
        $isPetugas = auth('petugas')->check();

        if (!$isAdmin && !$isPetugas) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus semua ulasan.');
        }

        Review::truncate();

        return redirect()->back()->with('success', 'Semua ulasan berhasil dihapus.');
    }
}