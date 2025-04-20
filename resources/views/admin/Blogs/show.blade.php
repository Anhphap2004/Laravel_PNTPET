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

    /* Details container */
    .details-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 15px;
        margin-bottom: 20px;
    }
    
    /* Detail layout styles */
    .detail-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .detail-col-image {
        flex: 0 0 30%;
        max-width: 30%;
        padding-right: 10px;
        padding-left: 10px;
    }
    
    .detail-col-info {
        flex: 0 0 70%;
        max-width: 70%;
        padding-right: 10px;
        padding-left: 10px;
    }
    
    @media (max-width: 768px) {
        .detail-col-image, .detail-col-info {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .detail-col-image {
            margin-bottom: 15px;
        }
    }
    
    /* Image styles */
    .blog-image {
        width: 100%;
        border-radius: 5px;
        border: 1px solid #dee2e6;
        padding: 5px;
        background-color: #f8f9fa;
    }
    
    .image-placeholder {
        width: 100%;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        color: #6c757d;
    }
    
    /* Table styles */
    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .detail-table th, .detail-table td {
        padding: 10px;
        border: 1px solid #dee2e6;
    }
    
    .detail-table th {
        width: 30%;
        background-color: #f8f9fa;
        font-weight: 500;
        color: #495057;
    }
    
    /* Content section */
    .content-section, .comments-section {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    
    .section-content {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        min-height: 80px;
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
    
    /* Badge styles */
    .badge {
        display: inline-block;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 500;
        border-radius: 4px;
    }
    
    .badge-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-secondary {
        background-color: #e2e3e5;
        color: #383d41;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Chi tiết bài viết</h4>
        <p>Thông tin chi tiết về bài viết: {{ $blog->title }}</p>
    </div>
    
    <div class="details-container">
        <div class="detail-row">
            <div class="detail-col-image">
                @if(isset($blog->featured_image) && $blog->featured_image)
                    <img src="{{ asset('img/Blog/' . $blog->featured_image) }}" class="blog-image" alt="{{ $blog->title }}">
                @else
                    <div class="image-placeholder">
                        <span>Không có hình ảnh</span>
                    </div>
                @endif
            </div>
            
            <div class="detail-col-info">
                <table class="detail-table">
                    <tr>
                        <th>Tiêu đề</th>
                        <td>{{ $blog->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $blog->slug }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>{{ $blog->category }}</td>
                    </tr>
                    <tr>
                        <th>Ngày xuất bản</th>
                        <td>{{ \Carbon\Carbon::parse($blog->publish_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if($blog->status == 'published')
                                <span class="badge badge-success">Đã xuất bản</span>
                            @else
                                <span class="badge badge-secondary">{{ $blog->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Hiển thị</th>
                        <td>{{ $blog->visibility }}</td>
                    </tr>
                    <tr>
                        <th>Thẻ</th>
                        <td>{{ $blog->tags }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="content-section">
            <div class="section-title">Nội dung bài viết</div>
            <div class="section-content">
                {!! $blog->content !!}
            </div>
        </div>
        
        <div class="comments-section">
            <div class="section-title">Bình luận</div>
            <div class="section-content">
                {!! $blog->comment !!}
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">↩️ Quay lại danh sách</a>
            <a href="{{ route('admin.blogs.edit', $blog->post_id) }}" class="btn btn-primary">✏️ Chỉnh sửa</a>
        </div>
    </div>
</div>
@endsection