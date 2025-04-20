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

    /* Message content section */
    .message-section {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
    }

    .message-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .message-content {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        min-height: 80px;
        white-space: pre-line;
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

    .btn-info {
        color: #fff;
        background-color: #17a2b8;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
    }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Chi tiết tin nhắn liên hệ</h4>
        <p>Xem thông tin chi tiết tin nhắn từ: {{ $message->name }}</p>
    </div>

    <div class="details-container">
        <table class="detail-table">
            <tr>
                <th>Họ tên</th>
                <td>{{ $message->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $message->email }}</td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td>{{ $message->phone ?: 'Không có' }}</td>
            </tr>
            <tr>
                <th>Chủ đề</th>
                <td>{{ $message->subject }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    @if ($message->status == 0)
                        <span class="badge badge-warning">Chưa đọc</span>
                    @else
                        <span class="badge badge-success">Đã đọc</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>IP gửi</th>
                <td>{{ $message->ip_address }}</td>
            </tr>
            <tr>
                <th>Thời gian gửi</th>
                <td>{{ date('d/m/Y H:i:s', strtotime($message->created_at)) }}</td>
            </tr>
        </table>

        <div class="message-section">
            <div class="message-title">Nội dung tin nhắn</div>
            <div class="message-content">
                {{ $message->message }}
            </div>
        </div>

        <div class="action-buttons">
            {{-- <form action="{{ route('admin.contact.updateStatus', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-info">
                    @if ($message->status == 0)
                        ✓ Đánh dấu đã đọc
                    @else
                        ○ Đánh dấu chưa đọc
                    @endif
                </button>
            </form> --}}
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">↩️ Quay lại danh sách</a>
        </div>
    </div>
</div>
@endsection