<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminAnimalsController extends Controller
{
    // Hiển thị danh sách động vật
    public function index()
    {
        $animals = DB::table('animals')->orderByDesc('animal_id')->get();
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        // Lấy tất cả danh mục từ bảng animal_categories
        $categories = DB::table('animal_categories')->get();

        // Trả về view với dữ liệu danh mục
        return view('admin.animals.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'description' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'entry_date' => 'nullable|date',
            'exit_date' => 'nullable|date',
        ]);

        // Xử lý upload ảnh
        $imageName = null;
        if ($request->hasFile('image')) {
            // Lấy file từ request
            $image = $request->file('image');

            // Tạo tên file duy nhất với timestamp + slug từ tên động vật + phần mở rộng
            $imageName = time() . '-' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();

            // Di chuyển file vào thư mục đích
            // $image->move(public_path('uploads/animals'), $imageName);
            $image->move(public_path('img/Animal'), $imageName);
        }

        // Insert vào DB (không dùng model)
        DB::table('animals')->insert([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'breed' => $request->breed,
            'gender' => $request->gender,
            'age' => $request->age,
            'weight' => $request->weight,
            'height' => $request->height,
            'image' => $imageName,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'entry_date' => $request->entry_date,
            'exit_date' => $request->exit_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.animals.index')->with('success', 'Thêm động vật thành công!');
    }
    // Hiển thị chi tiết
    public function show($id)
    {
        $animal = DB::table('animals')->where('animal_id', $id)->first();
        if (!$animal) return abort(404);
        return view('admin.animals.show', compact('animal'));
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        // Lấy thông tin động vật từ bảng animals theo ID
        $animal = DB::table('animals')->where('animal_id', $id)->first();

        if (!$animal) {
            return abort(404);
        }

        // Lấy danh sách các loại động vật từ bảng animal_categories
        $categories = DB::table('animal_categories')->get();

        // Trả về view với dữ liệu động vật và danh sách các danh mục
        return view('admin.animals.edit', compact('animal', 'categories'));
    }

    // Cập nhật thông tin
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'entry_date' => 'nullable|date',
            'exit_date' => 'nullable|date',
        ]);

        $animal = DB::table('animals')->where('animal_id', $id)->first();
        if (!$animal) return abort(404);

        $data = $request->except('_token', '_method', 'image');

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($animal->image && File::exists(public_path('img/Animal/' . $animal->image))) {
                File::delete(public_path('img/Animal/' . $animal->image));
            }

            // Lấy file từ request
            $image = $request->file('image');

            // Tạo tên file duy nhất với timestamp + slug từ tên động vật + phần mở rộng
            $imageName = time() . '-' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();

            // Di chuyển file vào thư mục đích
            $image->move(public_path('img/Animal'), $imageName);

            $data['image'] = $imageName;
        }

        $data['updated_at'] = now();

        DB::table('animals')->where('animal_id', $id)->update($data);

        return redirect()->route('admin.animals.index')->with('success', 'Đã cập nhật thông tin động vật thành công!');
    }

    // Xóa bản ghi
    public function destroy($id)
    {
        // Xóa động vật với ID tương ứng
        DB::table('animals')->where('animal_id', $id)->delete();

        // Quay lại trang danh sách động vật với thông báo thành công
        return redirect()->route('admin.animals.index')->with('success', 'Động vật đã được xóa thành công.');
    }
}
