<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function show()
    {
        return view('Contact');
    }

    // Xử lý form liên hệ
    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Lưu vào database
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact.show')->with('success', 'Gửi liên hệ thành công!');
    }
}
