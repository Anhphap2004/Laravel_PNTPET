<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAnimalCategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('animal_categories')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.animalcategories.index', compact('categories'));
    }

   // Phương thức edit để lấy thông tin của danh mục động vật cần sửa
 // Phương thức edit để lấy thông tin của danh mục động vật cần sửa
 public function edit($id)
 {
     $categories = DB::table('animal_categories')->where('category_id', $id)->first();
     return view('admin.animalcategories.edit', compact('categories'));  // Đảm bảo tên view chính xác
 }
 

   // Phương thức update để xử lý việc lưu thay đổi
   // Phương thức update để xử lý việc lưu thay đổi
   public function update(Request $request, $id)
   {
       // Kiểm tra và validate dữ liệu đầu vào
       $request->validate([
           'category_name' => 'required|string|max:255',
           'description' => 'nullable|string|max:500',
           'parent_category_id' => 'nullable|integer',
           'status' => 'required|in:1,0',  // Đảm bảo trạng thái là 1 hoặc 0
       ]);
   
       // Cập nhật danh mục động vật
       $update = DB::table('animal_categories')
           ->where('category_id', $id)
           ->update([
               'category_name' => $request->category_name,
               'description' => $request->description,
               'parent_category_id' => $request->parent_category_id,
               'status' => $request->status,
               'updated_at' => now(),
           ]);
   
       // Kiểm tra xem cập nhật có thành công không
       if ($update) {
           return redirect()->route('admin.animalcategories.index')->with('success', 'Cập nhật danh mục thành công');
       } else {
           return redirect()->route('admin.animalcategories.index')->with('error', 'Không có thay đổi nào');
       }
   }
   

}
