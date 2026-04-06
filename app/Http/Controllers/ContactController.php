<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * User side: Store a newly created message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan Anda telah terkirim! Kami akan menghubungi Anda segera.');
    }

    /**
     * Admin/Staff side: Display a listing of messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        $role = $this->userRole();
        
        return view($role . '.contact.index', compact('messages'));
    }

    /**
     * Admin/Staff side: Display the specified message.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
        
        $role = $this->userRole();
        return view($role . '.contact.show', compact('message'));
    }

    /**
     * Admin/Staff side: Remove the specified message.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    private function userRole()
    {
        if (auth('admin')->check()) {
            return 'admin';
        }

        if (auth('petugas')->check()) {
            return 'petugas';
        }

        return 'user';
    }
}
