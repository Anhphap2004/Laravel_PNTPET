<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $about = DB::table('about')->first();
        $services = DB::table('services')->limit(6)->get();
        $animals = DB::table('animals')->get(); // Lấy tất cả dữ liệu từ bảng animals
        $prices = DB::table('price_service')->get();
        $gallery = DB::table('gallery')->get();
        $testimonial = DB::table('testimonial')->get();
        $blogs = DB::table('blog_posts')->get();

        return view('index', compact('about', 'services', 'animals','prices','gallery', 'testimonial','blogs'));
    }
}
