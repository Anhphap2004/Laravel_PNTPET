<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng từ bảng users
        return view('admin.users.index', compact('users')); // Trả về view
    }

    // Hiển thị form thêm người dùng
    public function create()
    {
        return view('admin.users.create');
    }

    // Xử lý việc thêm người dùng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable',
            'address' => 'nullable',
            'role' => 'required|in:admin,customer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
            
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm thành công.');
    }
    public function show($id)
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu bằng ID
        $user = User::findOrFail($id);
    
        // Trả về view và truyền dữ liệu người dùng
        return view('admin.users.show', compact('user'));
    }
    
 // Xóa người dùng
public function destroy($id)
{
    // Tìm người dùng theo ID
    $user = DB::table('users')->where('user_id', $id)->first();

    if (!$user) {
        return redirect()->route('admin.users.index')->with('error', 'Người dùng không tồn tại.');
    }

    // Xoá người dùng
    DB::table('users')->where('user_id', $id)->delete();

    return redirect()->route('admin.users.index')->with('success', 'Xoá người dùng thành công.');
}



public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->username = $request->username;
    $user->email = $request->email;
    $user->role = $request->role;

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công!');
}

 
}
