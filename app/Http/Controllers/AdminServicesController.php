<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminServicesController extends Controller
{
    // Trang danh sách
    public function index()
    {
        $services = DB::table('services')->get();
        return view('admin.services.index', compact('services'));
    }

    // Trang thêm mới
    public function create()
    {
        return view('admin.services.create');
    }

    // Lưu dữ liệu thêm mới
    public function store(Request $request)
    {
        $iconPath = null;

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('images/services', 'public');
        }

        DB::table('services')->insert([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'icon' => $iconPath,
            'status' => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    // Trang sửa
    public function edit($id)
    {
        $service = DB::table('services')->where('service_id', $id)->first();
        return view('admin.services.edit', compact('service'));
    }

    // Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $data = [
            'service_name' => $request->service_name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('images/services', 'public');
        }

        DB::table('services')->where('service_id', $id)->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }
    public function show($id)
    {
        // Lấy dịch vụ theo ID từ cơ sở dữ liệu bằng DB facade
        $service = DB::table('services')->where('service_id', $id)->first();

        // Kiểm tra nếu không tìm thấy dịch vụ
        if (!$service) {
            abort(404, 'Dịch vụ không tồn tại');
        }

        // Trả về view chi tiết dịch vụ
        return view('admin.services.show', compact('service'));
    }
    public function destroy($id)
{
    // Xóa dịch vụ theo ID
    DB::table('services')->where('service_id', $id)->delete();

    // Quay lại trang danh sách với thông báo thành công
    return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được xóa thành công.');
}
}
