<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminAboutController extends Controller
{
    public function index()
    {
        // Lấy dòng dữ liệu đầu tiên trong bảng abouts
        $about = DB::table('about')->first();

        // Trả về view admin.about.index và truyền dữ liệu
        return view('admin.about.index', compact('about'));
    }

    // Hàm hiển thị form tạo mới
    public function create()
    {
        return view('admin.about.create');
    }

    // Hàm lưu dữ liệu vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Lưu ảnh vào thư mục public/img (nếu có ảnh)
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        }
    
        // Thêm dữ liệu vào bảng 'about'
        DB::table('about')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('admin.about.index')->with('success', 'About added successfully');
    }

    public function edit($id)
    {
        $about = DB::table('about')->where('id', $id)->first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Lấy dữ liệu cũ để kiểm tra ảnh
        $about = DB::table('about')->where('id', $id)->first();
        
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'updated_at' => now(),
        ];

        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($about->image && File::exists(public_path('img/' . $about->image))) {
                File::delete(public_path('img/' . $about->image));
            }
            
            // Lưu ảnh mới
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $data['image'] = $imageName;
        }

        // Cập nhật dữ liệu
        DB::table('about')->where('id', $id)->update($data);

        return redirect()->route('admin.about.index')->with('success', 'Cập nhật thành công');
    }
}