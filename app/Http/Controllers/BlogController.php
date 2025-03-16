<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function index(Request $request)
    {
        $postsPerPage = 5;
        $page = $request->query('page', 1);
        $start = ($page - 1) * $postsPerPage;

        // Lấy danh sách bài viết có phân trang
        $posts = DB::table('blog_posts')
            ->orderBy('date', 'desc')
            ->offset($start)
            ->limit($postsPerPage)
            ->get();

        // Lấy tổng số bài viết
        $totalPosts = DB::table('blog_posts')->count();
        $totalPages = ceil($totalPosts / $postsPerPage);

        // Lấy danh mục từ bảng blog_posts (loại bỏ trùng lặp)
        $categories = DB::table('blog_posts')
            ->select('category')
            ->distinct()
            ->pluck('category');

        // Lấy bài viết gần nhất
        $recentPosts = DB::table('blog_posts')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('blogs.index', compact('posts', 'page', 'totalPages', 'categories', 'recentPosts'));
    }
    public function show($id)
    {
        // Lấy bài viết theo ID
        $post = DB::table('blog_posts')->where('post_id', $id)->first();

        if (!$post) {
            abort(404);
        }

        // Lấy danh mục từ bảng blog_posts
        $categories = DB::table('blog_posts')
            ->select('category')
            ->distinct()
            ->pluck('category');

        // Lấy bài viết gần nhất
        $recentPosts = DB::table('blog_posts')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();


        // Lấy danh sách bình luận
        $comments = DB::table('blog_comments')
            ->leftJoin('users', 'users.user_id', '=', 'blog_comments.user_id')
            ->where('post_id', $id)
            ->orderBy('blog_comments.created_at', 'desc')
            ->select('users.profile_image', 'users.full_name', 'blog_comments.*')
            ->get();

        return view('blogs.detail', compact('post', 'categories', 'recentPosts','comments'));
    }
    public function blogcomment(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'post_id' => 'required|integer',
            'name' => Auth::check() ? 'nullable' : 'required|string|max:255', // Nếu chưa đăng nhập, bắt buộc nhập name
            'email' => Auth::check() ? 'nullable' : 'required|email|max:255', // Nếu chưa đăng nhập, bắt buộc nhập email
        ]);

        if (Auth::check()) {
            $user_id = Auth::id();
            $name = Auth::user()->username;
            $email = Auth::user()->email;
        } else {
            $user_id = null;
            $name = $request->name;
            $email = $request->email;
        }

        // Lưu vào database
        DB::table('blog_comments')->insert([
            'user_id' => $user_id,
            'post_id' => $request->post_id,
            'author_name' => $name,
            'author_email' => $email, // ✅ Đổi 'author_email' thành 'email'
            'content' => $request->content,
            'status' => 'pending', // Bình luận chờ duyệt
            'created_at' => now(),
            'image' => 'default.jpg', // ✅ Thêm giá trị mặc định
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi!');
    }
}
