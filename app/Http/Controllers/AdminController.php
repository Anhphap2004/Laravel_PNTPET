<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Kiểm tra nếu không phải admin thì không cho vào
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.dashboard'); // Hiển thị trang Admin
        }

        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập!');
    }



    public function logout(Request $request)
    {
        // Chỉ đăng xuất khỏi admin, nhưng vẫn giữ session user
        if (Auth::user()->role === 'admin') {
            session()->forget(['admin_access']); // Xóa quyền admin nếu có
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}
