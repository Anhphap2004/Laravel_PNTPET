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

    /* Service detail container */
    .service-detail {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 15px;
        margin-bottom: 20px;
    }

    .service-detail h3 {
        color: #1a3b5d;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }

    /* Detail rows */
    .detail-row {
        margin-bottom: 12px;
        padding: 8px 0;
        border-bottom: 1px dotted #efefef;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: 500;
        color: #555;
        display: inline-block;
        width: 120px;
    }

    .value {
        color: #333;
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
        text-decoration: none;
    }

    .btn-back {
        color: #333;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
    }

    .btn-back:hover {
        background-color: #e0e0e0;
        text-decoration: none;
    }

    .btn-edit {
        color: #fff;
        background-color: #1a3b5d;
        border: none;
    }

    .btn-edit:hover {
        background-color: #2c5282;
        text-decoration: none;
    }

    /* Actions container */
    .actions {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }
    
    .mt-3 {
        margin-top: 15px;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Thông tin dịch vụ</h4>
        <p>Xem chi tiết dịch vụ trong hệ thống.</p>
    </div>
    
    <div class="service-detail">
        <h3>Chi tiết dịch vụ</h3>
        
        <div class="detail-row">
            <span class="label">Tên dịch vụ:</span>
            <span class="value">{{ $service->service_name }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Mô tả:</span>
            <span class="value">{{ $service->description }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Giá:</span>
            <span class="value">{{ number_format($service->price, 0, ',', '.') }}đ</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Trạng thái:</span>
            <span class="value">
                @if($service->status == 1)
                    <span style="color: green;">✓ Hiển thị</span>
                @else
                    <span style="color: #d9534f;">✗ Ẩn</span>
                @endif
            </span>
        </div>
        
        <div class="detail-row">
            <span class="label">Ngày tạo:</span>
            <span class="value">{{ \Carbon\Carbon::parse($service->created_at)->format('d/m/Y') }}</span>
        </div>
        
        <div class="actions">
            <a href="{{ route('admin.services.index') }}" class="btn btn-back">
                <i class="fa fa-arrow-left"></i> Quay lại danh sách dịch vụ
            </a>
            <a href="{{ route('admin.services.edit', $service->service_id) }}" class="btn btn-edit">
                <i class="fa fa-edit"></i> Chỉnh sửa
            </a>
        </div>
    </div>
</div>
@endsection