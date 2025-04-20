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

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
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

    .form-control {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #1a3b5d;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
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
    
    /* Image preview */
    .image-preview {
        margin-top: 8px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: inline-block;
    }
    
    .image-preview img {
        max-width: 200px;
        height: auto;
    }
    
    .mt-2 {
        margin-top: 10px;
    }
    
    /* Form layout */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .form-col {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 10px;
        padding-left: 10px;
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
        <h4>Chỉnh sửa động vật</h4>
        <p>Cập nhật thông tin động vật trong hệ thống.</p>
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
        
        <form action="{{ route('admin.animals.update', $animal->animal_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="name">Tên động vật</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $animal->name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ $animal->category_id == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="breed">Giống</label>
                        <input type="text" id="breed" name="breed" class="form-control" value="{{ $animal->breed }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="male" {{ $animal->gender == 'male' ? 'selected' : '' }}>Đực</option>
                            <option value="female" {{ $animal->gender == 'female' ? 'selected' : '' }}>Cái</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="age">Tuổi</label>
                        <input type="number" id="age" name="age" class="form-control" value="{{ $animal->age }}">
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label for="weight">Cân nặng</label>
                        <input type="number" step="0.01" id="weight" name="weight" class="form-control" value="{{ $animal->weight }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="height">Chiều cao</label>
                        <input type="number" step="0.01" id="height" name="height" class="form-control" value="{{ $animal->height }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1" {{ $animal->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $animal->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="entry_date">Ngày nhập</label>
                        <input type="date" id="entry_date" name="entry_date" class="form-control" value="{{ $animal->entry_date }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="exit_date">Ngày xuất</label>
                        <input type="date" id="exit_date" name="exit_date" class="form-control" value="{{ $animal->exit_date }}">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($animal->image)
                    <div class="image-preview mt-2">
                        <img src="{{ asset('img/Animal/' . $animal->image) }}" alt="{{ $animal->name }}">
                    </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ $animal->description }}</textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                <a href="{{ route('admin.animals.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection