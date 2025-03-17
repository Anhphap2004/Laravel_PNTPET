<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Kiểm tra đăng nhập
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user(); // Lấy thông tin user đã đăng nhập

            // Lưu thông tin vào session
            session()->put('user_id', $user->id);
            session()->put('username', $user->username);
            session()->put('role', $user->role); // Lưu role vào session

            // Kiểm tra vai trò và điều hướng
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin!');
            } else {
                return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
            }
        }

        return back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác.']);
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function processRegister(Request $request)
    {
        // Validation dữ liệu
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // Lưu thông tin người dùng và gán giá trị 'customer' cho cột role
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password); // Mã hóa mật khẩu
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;

        $user->role = 'customer'; // Gán role mặc định là 'customer'
        $user->profile_image = 'default.png';
        $user->save();

        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất user khỏi hệ thống
        $request->session()->invalidate(); // Xóa tất cả session
        $request->session()->regenerateToken(); // Tạo lại CSRF token

        return redirect()->route('home')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}
