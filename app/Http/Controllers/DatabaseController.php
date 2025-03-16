<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function checkConnection()
    {
        try {
            // Kiểm tra kết nối bằng cách truy vấn danh sách các bảng
            $tables = DB::select('SHOW TABLES');

            return view('database-status', ['status' => 'Kết nối thành công!', 'tables' => $tables]);
        } catch (\Exception $e) {
            return view('database-status', ['status' => 'Lỗi kết nối: ' . $e->getMessage(), 'tables' => []]);
        }
    }
}
