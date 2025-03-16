<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        // Lấy danh sách dịch vụ từ database, giới hạn 6 bản ghi
        $services = DB::table('services')->get();
        $prices = DB::table('price_service')->get();
        return view('service', compact('services', 'prices'));
    }
}
