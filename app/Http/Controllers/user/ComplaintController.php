<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    public function create($order_id)
    {
        $order = Order::findOrFail($order_id);

        // Basic validation: User must own the order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if package is delayed (7+ days)
        $is_delayed = false;
        if ($order->tanggal) {
            $order_date = Carbon::parse($order->tanggal);
            $is_delayed = $order_date->diffInDays(Carbon::now()) >= 7;
        }

        return view('user.complaints.create', compact('order', 'is_delayed'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'type' => 'required|in:DAMAGED,DELAYED',
            'description' => 'required|string',
            'evidence_video' => 'required_if:type,DAMAGED|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:51200', // 50MB limit
        ]);

        $order = Order::findOrFail($request->order_id);
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $complaint = new Complaint();
        $complaint->user_id = Auth::id();
        $complaint->order_id = $request->order_id;
        $complaint->type = $request->type;
        $complaint->description = $request->description;

        if ($request->hasFile('evidence_video')) {
            $path = $request->file('evidence_video')->store('complaints_videos', 'public');
            $complaint->evidence_video = $path;
        }

        $complaint->save();

        return redirect()->route('orders')->with('success', 'Komplain berhasil diajukan. Petugas kami akan segera meninjau.');
    }
}
