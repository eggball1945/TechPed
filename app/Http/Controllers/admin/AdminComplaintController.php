<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with(['user', 'order'])->latest()->get();
        $viewPath = Auth::guard('admin')->check() ? 'admin.complaints.index' : 'petugas.complaints.index';
        return view($viewPath, compact('complaints'));
    }

    public function show($id)
    {
        $complaint = Complaint::with(['user', 'order', 'petugas'])->findOrFail($id);
        $viewPath = Auth::guard('admin')->check() ? 'admin.complaints.show' : 'petugas.complaints.show';
        return view($viewPath, compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,IN_PROGRESS,RESOLVED,REJECTED',
            'petugas_id' => 'nullable|exists:petugas,id'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        
        // Assigning current petugas if not already assigned
        if (!$complaint->petugas_id && Auth::guard('petugas')->check()) {
            $complaint->petugas_id = Auth::guard('petugas')->id();
        }

        $complaint->save();

        $routeName = Auth::guard('admin')->check() ? 'admin.complaints.index' : 'petugas.complaints.index';
        return redirect()->route($routeName)->with('success', 'Status komplain berhasil diperbarui.');
    }
}
