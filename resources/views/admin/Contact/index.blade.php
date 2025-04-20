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

    /* Alert styles */
    .alert {
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
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

    /* Table container */
    .table-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 15px;
        margin-bottom: 20px;
        overflow-x: auto;
    }
    
    /* Table styles */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    
    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }
    
    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .table tr:hover {
        background-color: #f8f9fa;
    }
    
    /* Badge styles */
    .badge {
        display: inline-block;
        padding: 5px 8px;
        font-size: 12px;
        font-weight: 500;
        border-radius: 4px;
    }
    
    .badge-warning {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .badge-success {
        background-color: #d4edda;
        color: #155724;
    }

    /* Button styles */
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        padding: 6px 10px;
        font-size: 13px;
        line-height: 1.5;
        border-radius: 4px;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .btn-primary {
        color: #fff;
        background-color: #1a3b5d;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2c5282;
    }
    
    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
    
    .btn-info {
        color: #fff;
        background-color: #17a2b8;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
    }
    
    /* Button group */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
    }
    
    /* Pagination */
    .pagination-container {
        margin-top: 20px;
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Danh sách tin nhắn liên hệ</h4>
        <p>Quản lý và xem các tin nhắn từ khách hàng</p>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->message_id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->phone }}</td>
                        <td>{{ Str::limit($message->subject, 30) }}</td>
                        <td>
                            @if ($message->status == 0)
                                <span class="badge badge-warning">Chưa đọc</span>
                            @else
                                <span class="badge badge-success">Đã đọc</span>
                            @endif
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($message->created_at)) }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.contact.show', $message->message_id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                              
                                
                                <form action="{{ route('admin.contact.destroy', $message->message_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin nhắn này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="pagination-container">
        {{ $messages->links() }}
    </div>
</div>
@endsection