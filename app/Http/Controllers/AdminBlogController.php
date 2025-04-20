<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = DB::table('blog_posts')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:100',
            'slug' => 'required|unique:blog_posts,slug',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,pending',
            'visibility' => 'required|in:public,private',
            'publish_date' => 'nullable|date',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Store image in the public/img/Blog directory
            $image->move(public_path('img/Blog'), $imageName);
        }

        // Process allow_comments checkbox
        $allowComments = $request->has('allow_comments') ? 1 : 0;

        // Insert into database
        DB::table('blog_posts')->insert([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imageName, // Use the uploaded image name         
            'status' => $request->status,
            'visibility' => $request->visibility,
            'publish_date' => $request->publish_date,
            'category' => $request->category,
            'tags' => $request->tags,
            'author_id' => 1, 
            'view_count' => 0,
            'date' => now(), // Hoặc truyền ngày tự chọn
            'comment' => $request->comment ?? '',  // Nếu không có giá trị comment, gán rỗng
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Bài viết đã được tạo thành công!');
    }


public function edit($id)
{
    $blog = DB::table('blog_posts')->where('post_id', $id)->first();
    return view('admin.blogs.edit', compact('blog'));
}

public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'title' => 'required|max:255',
        'slug' => 'required|max:255',
        'content' => 'required',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Get the current blog post
    $blog = DB::table('blog_posts')->where('post_id', $id)->first();
    
    // Handle image upload
    $featured_image = $blog->featured_image; // Default to current image
    
    if ($request->hasFile('featured_image')) {
        // Get file and generate name
        $image = $request->file('featured_image');
        $imageName = time() . '_' . $request->slug . '.' . $image->getClientOriginalExtension();
        
        // Move the image to the public directory
        $image->move(public_path('img/Blog'), $imageName);
        
        // Delete old image if it exists
        if ($blog->featured_image && file_exists(public_path('img/Blog/' . $blog->featured_image))) {
            unlink(public_path('img/Blog/' . $blog->featured_image));
        }
        
        // Set the new image name
        $featured_image = $imageName;
    }
    
    // Update the blog post
    DB::table('blog_posts')->where('post_id', $id)->update([
        'title' => $request->title,
        'slug' => $request->slug,
        'content' => $request->content,
        'excerpt' => $request->excerpt,
        'featured_image' => $featured_image,
        'status' => $request->status,
        'visibility' => $request->visibility,
        'publish_date' => $request->publish_date,
        'category' => $request->category,
        'tags' => $request->tags,
        'comment' => 'nullable', // Nếu không muốn bắt buộc, có thể để 'nullable'
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.blogs.index')->with('success', 'Đã cập nhật bài viết thành công');
}






public function destroy($id)
{
    // Xóa bài viết với post_id tương ứng
    DB::table('blog_posts')->where('post_id', $id)->delete();

    // Quay lại trang danh sách với thông báo thành công
    return redirect()->route('admin.blogs.index')->with('success', 'Đã xóa bài viết');
}
    public function show($id)
    {
        $blog = DB::table('blog_posts')->where('post_id', $id)->first();
    
        // Kiểm tra nếu bài viết không tồn tại
        if (!$blog) {
            return redirect()->route('admin.blogs.index')->with('error', 'Bài viết không tồn tại');
        }
    
        return view('admin.blogs.show', compact('blog'));
    }
    
}
