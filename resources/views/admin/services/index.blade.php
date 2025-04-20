@extends('admin.layouts.master')

@section('content')
<style>
    /* --- CSS giữ nguyên như mẫu bạn đã đưa --- */
    .content-wrapper { margin-left: 230px; padding: 15px 20px 0 20px; background-color: white; }
    @media (max-width: 992px) { .content-wrapper { margin-left: 0; padding: 10px; } }
    .page-intro { margin-bottom: 15px; }
    .page-intro h4 { margin-top: 0; margin-bottom: 5px; color: #333; font-weight: 600; }
    .page-intro p { margin-bottom: 10px; color: #666; }
    .table-container { background-color: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 15px; margin-bottom: 20px; overflow-x: auto; }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .table-header h5 { margin: 0; color: #1a3b5d; font-weight: 600; }
    .btn-primary { background-color: #1a3b5d; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px; }
    .btn-outline-secondary { background-color: white; color: #6c757d; border: 1px solid #6c757d; padding: 5px 11px; border-radius: 4px; }
    .compact-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .compact-table th, .compact-table td { padding: 10px 8px; border-bottom: 1px solid #e9ecef; text-align: left; }
    .compact-table thead { background-color: #f8f9fa; }
    .badge { padding: 3px 6px; border-radius: 12px; font-size: 11px; font-weight: 500; }
    .badge-success { background-color: #e8f5e9; color: #2e7d32; }
    .badge-secondary { background-color: #f0f0f0; color: #666; }
    .action-links a { margin: 0 3px; padding: 4px 6px; border-radius: 4px; text-decoration: none; color: #1a3b5d; }
    .action-links a:hover { background-color: #f0f0f0; }
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Quản lý danh sách dịch vụ</h4>
        <p>Thêm, chỉnh sửa và xoá các dịch vụ được cung cấp trong hệ thống.</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h5>Danh sách dịch vụ</h5>
            <a href="{{ route('admin.services.create') }}" class="btn-primary">
                <i class="fa fa-plus-circle"></i> Thêm mới
            </a>
        </div>

        <table class="compact-table">
            <thead>
                <tr>
                    <th>Tên dịch vụ</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->service_name }}</td>
                    <td style="max-width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                        {{ $service->description }}
                    </td>
                    <td>{{ number_format($service->price, 0, ',', '.') }}đ</td>
                    <td>
                        @if($service->status == 1)
                            <span class="badge badge-success">Hiển thị</span>
                        @else
                            <span class="badge badge-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d/m/Y') }}</td>

                    <td class="action-links">
                        <a href="{{ route('admin.services.edit', $service->service_id) }}" title="Chỉnh sửa">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.services.show', $service->service_id) }}" title="Xem chi tiết">
                            <i class="fa fa-eye"></i>
                        </a>
                      <!-- Form xóa dịch vụ -->
    <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <i class="fa fa-trash" style="color: red;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>
@endsection
