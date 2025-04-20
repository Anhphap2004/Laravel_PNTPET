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
        margin-bottom: 15px;
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
        padding: 15px;
        margin-bottom: 20px;
    }

    /* Form alerts */
    .alert {
        padding: 12px 15px;
        margin-bottom: 15px;
        border-radius: 4px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert ul {
        margin-top: 5px;
        margin-bottom: 0;
        padding-left: 20px;
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #495057;
        margin-bottom: 5px;
    }

    .form-input {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out;
    }

    .form-input:focus {
        border-color: #1a3b5d;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
    }

    .form-select {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        appearance: auto;
        background-color: #fff;
    }

    .form-select:focus {
        border-color: #1a3b5d;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
    }

    .form-textarea {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out;
        min-height: 120px;
        resize: vertical;
    }

    .form-textarea:focus {
        border-color: #1a3b5d;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
    }

    /* File input styling */
    .file-input-container {
        position: relative;
    }

    .file-input-preview {
        margin-top: 10px;
        width: 150px;
        height: 150px;
        border: 2px dashed #ced4da;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .file-input-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .file-input-preview-text {
        color: #6c757d;
        font-size: 13px;
        text-align: center;
    }

    /* Button styles */
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        padding: 8px 12px;
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

    /* Form actions */
    .form-actions {
        margin-top: 20px;
        text-align: right;
        padding-top: 10px;
        border-top: 1px solid #e9ecef;
    }
    
    /* Form columns */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .form-col {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 0 10px;
    }
    
    @media (max-width: 768px) {
        .form-col {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Thêm động vật mới</h4>
        <p>Nhập thông tin chi tiết về động vật để thêm vào hệ thống quản lý.</p>
    </div>
    
    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ôi hỏng!</strong> Có lỗi xảy ra nè:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.animals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label>Tên:</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Loài:</label>
                        <select name="category_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Giống:</label>
                        <input type="text" name="breed" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label>Giới tính:</label>
                        <select name="gender" class="form-select" required>
                            <option value="male">Đực</option>
                            <option value="female">Cái</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tuổi:</label>
                        <input type="number" name="age" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label>Cân nặng (kg):</label>
                        <input type="number" step="0.1" name="weight" class="form-input">
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label>Chiều cao (cm):</label>
                        <input type="number" step="0.1" name="height" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label>Ảnh:</label>
                        <div class="file-input-container">
                            <input type="file" name="image" class="form-input" id="image" accept="image/*" onchange="previewImage(this)">
                            <div class="file-input-preview" id="image-preview">
                                <div class="file-input-preview-text">
                                    <i class="fa fa-image" style="font-size: 24px; margin-bottom: 10px;"></i><br>
                                    Chọn ảnh
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Trạng thái:</label>
                        <select name="status" class="form-select">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Ngày nhập:</label>
                        <input type="date" name="entry_date" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label>Ngày xuất:</label>
                        <input type="date" name="exit_date" class="form-input">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Mô tả:</label>
                <textarea name="description" class="form-textarea" rows="5"></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Lưu thông tin</button>
                <a href="{{ route('admin.animals.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.innerHTML = '<div class="file-input-preview-text"><i class="fa fa-image" style="font-size: 24px; margin-bottom: 10px;"></i><br>Chọn ảnh</div>';
        }
    }
</script>
@endsection