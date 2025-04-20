<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    // Hiển thị danh sách menu
    public function index()
    {
        $menus = DB::table('menu_items')->orderBy('order_index')->get();
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
            'title' => 'required|string|max:100',
            'url' => 'nullable|string|max:255',
            'icon_class' => 'nullable|string|max:50',
            'target' => 'nullable|in:_self,_blank,_parent,_top',
            'order_index' => 'nullable|integer',
            'status' => 'in:active,inactive'
        ]);

        DB::table('menu_items')->insert([
            'menu_id' => $request->menu_id, // 🛑 phải có dòng này
            'title' => $request->title,
            'url' => $request->url,
            'icon_class' => $request->icon_class,
            'target' => $request->target ?? '_self',
            'order_index' => $request->order_index ?? 0,
            'status' => $request->status ?? 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        return redirect()->route('admin.menu.index')->with('success', '🧡 Thêm menu thành công!');
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
        // Tìm menu theo ID
        $menu = DB::table('menu_items')->where('item_id', $id)->first();
    
        if (!$menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu không tồn tại.');
        }
    
        // Xoá menu
        DB::table('menu_items')->where('item_id', $id)->delete();
    
        return redirect()->route('admin.menu.index')->with('success', 'Xoá menu thành công.');
    }
    
}
