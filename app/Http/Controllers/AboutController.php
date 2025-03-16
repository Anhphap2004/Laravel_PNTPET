<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu từ bảng about
        $about = DB::table('about')->first(); // Chỉ lấy dòng đầu tiên
        $owners = DB::table('owners')->get();
        return view('about', compact('about', 'owners'));
    }
}
?>
