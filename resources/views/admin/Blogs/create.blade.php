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

    /* Form container and styling */
    .form-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }

    .form-header h5 {
        margin: 0;
        color: #1a3b5d;
        font-weight: 600;
    }

    /* Form controls */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #495057;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #1a3b5d;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
    }

    .form-text {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #6c757d;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    select.form-control {
        height: auto;
        padding: 10px 12px;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        appearance: none;
    }

    /* Image upload */
    .image-upload-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .upload-preview {
        max-width: 200px;
        max-height: 130px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #dee2e6;
        padding: 3px;
        background-color: #f8f9fa;
    }

    .custom-file-upload {
        display: inline-block;
        padding: 8px 12px;
        cursor: pointer;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .custom-file-upload:hover {
        background-color: #e9ecef;
    }
    
    input[type="file"] {
        display: none;
    }

    /* Button styling */
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        padding: 8px 16px;
        font-size: 14px;
        line-height: 1.5;
        border-radius: 4px;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #1a3b5d;
        border: 1px solid #1a3b5d;
    }

    .btn-primary:hover {
        background-color: #132e49;
        border-color: #102640;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border: 1px solid #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    /* Alert message */
    .alert {
        padding: 12px 15px;
        margin-bottom: 15px;
        border-radius: 4px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    /* WYSIWYG editor styling */
    .editor-container {
        border: 1px solid #ced4da;
        border-radius: 4px;
        overflow: hidden;
    }

    .editor-toolbar {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ced4da;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .editor-button {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 3px;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .editor-button:hover {
        background-color: #e9ecef;
    }

    .editor-content {
        padding: 10px;
        min-height: 200px;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Thêm bài viết mới</h4>
        <p>Tạo nội dung và quản lý bài viết cho trang web.</p>
    </div>

    <div class="form-container">
        <div class="form-header">
            <h5>Thông tin bài viết</h5>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required>
                        <small class="form-text">Nhập tiêu đề bài viết (tối đa 100 ký tự)</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" required>
                        <small class="form-text">URL thân thiện của bài viết (chỉ dùng chữ cái, số và dấu gạch ngang)</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Tóm tắt (excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="3"></textarea>
                        <small class="form-text">Mô tả ngắn về bài viết sẽ hiển thị ở trang chủ</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                        <div class="editor-container">
                            <div class="editor-toolbar">
                                <button type="button" class="editor-button"><i class="fa fa-bold"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-italic"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-underline"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-link"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-image"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-list-ul"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-list-ol"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-quote-right"></i></button>
                                <button type="button" class="editor-button"><i class="fa fa-code"></i></button>
                            </div>
                            <textarea name="content" class="editor-content form-control" rows="10" required></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Ảnh đại diện</label>
                        <div class="image-upload-container">
                            <img id="image-preview" class="upload-preview" src="{{ asset('img/placeholder.jpg') }}" alt="Preview">
                            <label for="featured_image" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Chọn ảnh
                            </label>
                            <input type="file" name="featured_image" id="featured_image" accept="image/*">
                            <small class="form-text">Kích thước khuyến nghị: 1200x630px, tối đa 2MB</small>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="draft">Bản nháp</option>
                            <option value="published">Công khai</option>
                            <option value="pending">Chờ duyệt</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Hiển thị</label>
                        <select name="visibility" class="form-control">
                            <option value="public">Công khai</option>
                            <option value="private">Riêng tư</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Ngày đăng</label>
                        <input type="date" name="publish_date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Danh mục</label>
                        <select name="category" class="form-control">
                            <option value="uncategorized">Chưa phân loại</option>
                            <option value="news">Tin tức</option>
                            <option value="events">Sự kiện</option>
                            <option value="tips">Mẹo vặt</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Thẻ (tags)</label>
                        <input type="text" name="tags" class="form-control">
                        <small class="form-text">Nhập các thẻ phân cách bằng dấu phẩy</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Cho phép bình luận</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="commentSwitch" name="allow_comments" checked>
                            <label class="custom-control-label" for="commentSwitch">Bật</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-buttons">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Lưu bài viết
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('featured_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Auto-generate slug from title
    document.querySelector('input[name="title"]').addEventListener('keyup', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/đ/g, 'd')
            .replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a')
            .replace(/[éèẻẽẹêếềểễệ]/g, 'e')
            .replace(/[íìỉĩị]/g, 'i')
            .replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o')
            .replace(/[úùủũụưứừửữự]/g, 'u')
            .replace(/[ýỳỷỹỵ]/g, 'y')
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
        
        document.querySelector('input[name="slug"]').value = slug;
    });
</script>
@endsection