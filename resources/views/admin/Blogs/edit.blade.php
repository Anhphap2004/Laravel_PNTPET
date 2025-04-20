@extends('admin.layouts.master')

@section('content')
<style>
    /* Fix sidebar overlap issue */
    .content-wrapper {
        margin-left: 230px;
        padding: 15px 20px 0 20px;
        background-color: white;
    }

    /* Responsive adjustment for mobile */
    @media (max-width: 992px) {
        .content-wrapper {
            margin-left: 0;
            padding: 10px;
        }
    }

    /* Page header and intro */
    .page-intro {
        margin-bottom: 20px;
    }

    .page-intro h4 {
        margin-top: 0;
        margin-bottom: 5px;
        color: #333;
        font-weight: 600;
    }

    .page-intro p {
        margin-top: 0;
        margin-bottom: 10px;
        color: #666;
    }

    /* Form container */
    .form-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 20px;
    }
    
    /* Alert styles */
    .alert {
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    
    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    
    /* Form styles */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .form-col-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 10px;
        padding-left: 10px;
    }
    
    .form-col-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }
    
    @media (max-width: 768px) {
        .form-col-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #495057;
    }
    
    .form-control {
        display: block;
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out;
    }
    
    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
    }
    
    textarea.form-control {
        min-height: 100px;
    }
    
    /* Image preview section */
    .image-preview-container {
        margin-top: 10px;
    }
    
    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        border: 1px solid #dee2e6;
        padding: 3px;
    }
    
    /* Action buttons */
    .action-buttons {
        margin-top: 20px;
        text-align: right;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
    }
    
    /* Button styles */
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        padding: 8px 16px;
        font-size: 14px;
        line-height: 1.5;
        border-radius: 4px;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
        margin: 0 5px;
    }

    .btn-primary {
        color: #fff;
        background-color: #1a3b5d;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2c5282;
    }
    
    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
    
    /* Editor */
    .content-editor {
        min-height: 300px;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Chỉnh sửa bài viết</h4>
        <p>Cập nhật thông tin cho bài viết: {{ $blog->title }}</p>
    </div>
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="form-container">
        <form action="{{ route('admin.blogs.update', $blog->post_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col-6">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="excerpt">Mô tả ngắn</label>
                        <textarea id="excerpt" name="excerpt" class="form-control" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-col-6">
                    <div class="form-group">
                        <label for="featured_image">Hình ảnh nổi bật</label>
                        <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/*">
                        @error('featured_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        
                        <div class="image-preview-container">
                            @if(isset($blog->featured_image) && !empty($blog->featured_image))
                                <img src="{{ asset('img/Blog/' . $blog->featured_image) }}" class="image-preview" alt="Hình ảnh hiện tại">
                                <p class="text-muted">Hình ảnh hiện tại. Tải lên mới sẽ thay thế hình ảnh này.</p>
                            @else
                                <p class="text-muted">Chưa có hình ảnh.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                                    <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Nháp</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="visibility">Hiển thị</label>
                                <select id="visibility" name="visibility" class="form-control">
                                    <option value="public" {{ $blog->visibility == 'public' ? 'selected' : '' }}>Công khai</option>
                                    <option value="private" {{ $blog->visibility == 'private' ? 'selected' : '' }}>Riêng tư</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="publish_date">Ngày xuất bản</label>
                        <input type="date" id="publish_date" name="publish_date" class="form-control" value="{{ old('publish_date', isset($blog->publish_date) ? date('Y-m-d', strtotime($blog->publish_date)) : '') }}">
                        @error('publish_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col-6">
                    <div class="form-group">
                        <label for="category">Chuyên mục</label>
                        <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $blog->category) }}">
                    </div>
                </div>
                
                <div class="form-col-6">
                    <div class="form-group">
                        <label for="tags">Tags (phân cách bằng dấu phẩy)</label>
                        <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', $blog->tags) }}">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea id="content" name="content" class="form-control content-editor">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="comment">Bình luận</label>
                <textarea id="comment" name="comment" class="form-control" rows="3">{{ old('comment', $blog->comment) }}</textarea>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">↩️ Quay lại danh sách</a>
                <button type="submit" class="btn btn-primary">✅ Cập nhật bài viết</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-generate slug from title if empty
    document.getElementById('title').addEventListener('blur', function() {
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugField.value = slug;
        }
    });
    
    // Initialize rich text editor for content if available
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
@endsection