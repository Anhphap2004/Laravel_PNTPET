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

    /* Information container and styling */
    .info-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 15px;
        margin-bottom: 20px;
    }

    .info-header {
        padding: 12px 15px;
        border-bottom: 1px solid #e9ecef;
        margin-bottom: 15px;
    }

    .info-header h4 {
        margin: 0;
        color: #333;
        font-weight: 500;
    }

    .info-body {
        padding: 5px 0;
    }

    .info-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .info-col {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (max-width: 768px) {
        .info-col {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .info-item {
        margin-bottom: 10px;
    }

    .info-item strong {
        font-weight: 500;
        color: #495057;
    }

    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 150px;
        height: auto;
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
        margin-top: 15px;
    }

    .btn-primary {
        color: #fff;
        background-color: #1a3b5d;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2c5282;
    }

    /* Form actions */
    .info-actions {
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #e9ecef;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Thông tin người dùng</h4>
        <p>Chi tiết và thông tin tài khoản người dùng.</p>
    </div>
    
    <div class="info-container">
        <div class="info-header">
            <h4>Chi tiết tài khoản: {{ $user->name }}</h4>
        </div>
        
        <div class="info-body">
            <div class="info-row">
                <div class="info-col">
                    <div class="info-item">
                        <strong>Tên đăng nhập:</strong> {{ $user->username }}
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="info-item">
                        <strong>Số điện thoại:</strong> {{ $user->phone }}
                    </div>
                    <div class="info-item">
                        <strong>Địa chỉ:</strong> {{ $user->address }}
                    </div>
                    <div class="info-item">
                        <strong>Vai trò:</strong> {{ $user->role }}
                    </div>
                </div>
                
                <div class="info-col">
                    <div class="info-item">
                        <strong>Ảnh đại diện:</strong>
                        @if($user->profile_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$user->profile_image) }}" alt="Avatar" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @else
                            <div class="mt-1">Chưa có ảnh đại diện</div>
                        @endif
                    </div>
                    <div class="info-item">
                        <strong>Ngày tạo:</strong> {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'Chưa có ngày tạo' }}
                    </div>
                    <div class="info-item">
                        <strong>Đăng nhập cuối:</strong> {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Chưa đăng nhập' }}
                    </div>
                    <div class="info-item">
                        <strong>Trạng thái:</strong> {{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}
                    </div>
                </div>
            </div>
            
            <div class="info-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">↩️ Trở lại danh sách người dùng</a>
            </div>
        </div>
    </div>
</div>


@endsection