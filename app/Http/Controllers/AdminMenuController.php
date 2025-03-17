<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    // Hiển thị danh sách menu
    public function index()
    {
        $menus = DB::table('menu_items')->get(); // Lấy toàn bộ menu
        return view('admin.menu.index', compact('menus'));
    }

    // Hiển thị form thêm menu
    public function create()
    {
        return view('admin.menu.create');
    }

    // Xử lý thêm menu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        DB::table('menu_items')->insert([
            'name' => $request->name,
            'link' => $request->link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công!');
    }

    // Hiển thị form chỉnh sửa menu
    public function edit($id)
    {
        $menus = DB::table('menu_items')->where('item_id', $id)->first();
        return view('admin.menu.edit', compact('menus'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        // Xử lý checkbox status: nếu tick thì 'active', nếu không tick thì 'inactive'
        $status = $request->has('status') ? 'active' : 'inactive';

        // Cập nhật menu trong database
        DB::table('menu_items')->where('item_id', $id)->update([
            'title' => $request->title,
            'url' => $request->url,
            'status' => $status, // Cập nhật trạng thái
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Cập nhật menu thành công!');
    }


    // Xóa menu
    public function destroy($id)
    {
        DB::table('menu_items')->where('id', $id)->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Xóa menu thành công!');
    }
}
