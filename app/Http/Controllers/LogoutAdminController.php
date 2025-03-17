<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutAdminController extends Controller
{
    public function logoutAdmin(Request $request)
    {
        Auth::logout(); // Đăng xuất Admin

        $request->session()->invalidate(); // Xóa tất cả session
        $request->session()->regenerateToken(); // Tạo lại CSRF token

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}
