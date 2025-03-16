<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = DB::table('animals')->orderBy('created_at', 'desc')->get();
        return view('animals.index', compact('animals'));
    }

    public function detail($id)
    {
        // Lấy thông tin động vật
        $animal = DB::table('animals')->where('animal_id', $id)->first();

        if (!$animal) {
            abort(404, 'Bài viết không tồn tại.');
        }

        // Lấy danh sách bình luận
        $comments = DB::table('reviews')
            ->leftJoin('users', 'users.user_id', '=', 'reviews.user_id')
            ->where('animal_id', $id)
            ->orderBy('reviews.created_at', 'desc')
            ->select('users.profile_image', 'users.full_name', 'reviews.*')
            ->get();

        // Lấy danh mục của động vật
        $category = DB::table('animal_categories')
            ->where('category_id', $animal->category_id)
            ->first();

        // Lấy động vật liên quan cùng danh mục (loại trừ con hiện tại)
        $relatedAnimals = DB::table('animals')
            ->where('category_id', $animal->category_id)
            ->where('animal_id', '!=', $id)
            ->limit(5)
            ->get();

        return view('animals.show', compact('animal', 'comments', 'category', 'relatedAnimals'));
    }
    public function submitReview(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'animal_id' => 'required|integer',
        ]);

        if (Auth::check()) {  // Thay vì auth()->check()
            $user_id = Auth::id();
            $name = Auth::user()->username;
            $email = Auth::user()->email;
        } else {
            $user_id = null;
            $name = $request->name;
            $email = $request->email;
        }

        // Lưu vào database
        DB::table('reviews')->insert([
            'user_id' => $user_id,
            'animal_id' => $request->animal_id,
            'name' => $name,
            'email' => $email,
            'comment' => $request->comment,
            'status' => 'pending', // Bình luận chờ duyệt
            'created_at' => now(),
            'image' => 'default.jpg', // ✅ Thêm giá trị mặc định
        ]);


        return back()->with('success', 'Bình luận của bạn đã được gửi!');
    }
}

