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
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Sửa Menu</h4>
        <p>Chỉnh sửa thông tin menu và cài đặt hiển thị.</p>
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
        
        <form action="{{ route('admin.menu.update', $menus->item_id) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Tên Menu</label>
                <input type="text" name="title" value="{{ $menus->title }}" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label>Liên kết (URL)</label>
                <input type="text" name="url" value="{{ $menus->url }}" class="form-input">
            </div>
            
            <div class="form-group">
                <label>Icon Class (FontAwesome, Bootstrap Icon...)</label>
                <input type="text" name="icon_class" value="{{ $menus->icon_class }}" class="form-input">
            </div>
            
            <div class="form-group">
                <label>Target</label>
                <select name="target" class="form-select">
                    <option value="_self" {{ $menus->target === '_self' ? 'selected' : '' }}>_self</option>
                    <option value="_blank" {{ $menus->target === '_blank' ? 'selected' : '' }}>_blank</option>
                    <option value="_parent" {{ $menus->target === '_parent' ? 'selected' : '' }}>_parent</option>
                    <option value="_top" {{ $menus->target === '_top' ? 'selected' : '' }}>_top</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Thứ tự hiển thị</label>
                <input type="number" name="order_index" value="{{ $menus->order_index }}" class="form-input">
            </div>
            
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $menus->status === 'active' ? 'selected' : '' }}>Hiển thị</option>
                    <option value="inactive" {{ $menus->status === 'inactive' ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection