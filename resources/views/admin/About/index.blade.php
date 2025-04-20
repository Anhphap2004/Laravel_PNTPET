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

    /* Table container and styling */
    .table-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        padding: 15px;
        margin-bottom: 20px;
        overflow-x: auto;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .table-header h5 {
        margin: 0;
        color: #1a3b5d;
        font-weight: 600;
    }

    /* Action buttons */
    .btn-primary {
        background-color: #1a3b5d;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #2c5282;
    }

    .btn-outline-secondary {
        background-color: white;
        color: #6c757d;
        border: 1px solid #6c757d;
        padding: 5px 11px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }

    /* Table styling */
    .compact-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .compact-table thead {
        background-color: #f8f9fa;
    }

    .compact-table th {
        padding: 12px 8px;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        white-space: nowrap;
        text-align: left;
    }

    .compact-table td {
        padding: 10px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .compact-table tbody tr:hover {
        background-color: rgba(26, 59, 93, 0.04);
    }

    /* Status badges */
    .badge {
        display: inline-block;
        padding: 3px 6px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        text-align: center;
        white-space: nowrap;
    }

    .badge-primary {
        background-color: #cfe2ff;
        color: #0d6efd;
    }

    .badge-success {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .badge-secondary {
        background-color: #f0f0f0;
        color: #666;
    }

    /* Search input */
    .search-input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    
    .search-input:focus {
        border-color: #1a3b5d;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(26, 59, 93, 0.25);
    }

    /* Action links */
    .action-links {
        white-space: nowrap;
    }

    .action-links a {
        display: inline-block;
        margin: 0 3px;
        padding: 4px 6px;
        border-radius: 4px;
        text-decoration: none;
        color: #1a3b5d;
    }

    .action-links a:hover {
        background-color: #f0f0f0;
    }

    /* Pagination styles */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        margin: 15px 0 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #1a3b5d;
        border-color: #1a3b5d;
        color: white;
    }

    .pagination .page-link {
        padding: 5px 10px;
        color: #1a3b5d;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 3px;
        text-decoration: none;
    }

    .pagination .page-link:hover {
        background-color: #f8f9fa;
    }

    /* Footer */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #666;
        margin-top: 10px;
    }

    /* Status circle indicator */
    .status-circle {
        display: inline-block;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        color: white;
        line-height: 22px;
        font-size: 14px;
        text-align: center;
    }

    .status-active {
        background-color: #2e7d32;
    }

    .status-inactive {
        background-color: #e74c3c;
    }

    /* Action buttons */
    .btn-edit {
        background-color: #FFC107;
        color: #333;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 13px;
        margin-right: 5px;
    }
    
    .btn-delete {
        background-color: #FF5252;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    
    /* Image thumbnail */
    .img-thumbnail {
        max-width: 60px;
        height: auto;
        border-radius: 3px;
    }
    th {
    white-space: nowrap; /* Không cho nội dung xuống dòng */
    overflow: hidden; /* Ẩn phần nội dung vượt quá */
    text-overflow: ellipsis; /* Thêm dấu "..." khi quá dài */
    max-width: 100px; /* Giới hạn chiều rộng */
}

</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Quản lý thông tin Giới thiệu</h4>
        <p>Cập nhật nội dung và thông tin cho trang giới thiệu của hệ thống.</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h5>Thông tin Giới thiệu</h5>
            <div>
                <a href="{{ route('admin.about.create') }}" class="btn-primary">
                    <i class="fa fa-plus-circle"></i> Thêm mới
                </a>
            </div>
        </div>
        
        <div>
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm..." onkeyup="filterTable()">
        </div>
        
        <table class="compact-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Nội dung</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $about->id ?? '1' }}</td>
                    <td>{{ $about->title }}</td>
                    <th>{{ $about->content }}</th>
                    <td>
                        <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $about->description ?? 'Chưa có mô tả' }}
                        </div>
                    </td>
                    <td>
                        @if($about->image)
                            <img src="{{ asset('img/' . $about->image) }}" alt="Ảnh giới thiệu" class="img-thumbnail">
                        @else
                            <span class="badge badge-secondary">Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $about->created_at ?? 'N/A' }}</td>
                    <td>{{ $about->updated_at ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.about.edit', $about->id) }}" class="btn-edit">
                            <i class="fa fa-edit"></i> Sửa
                        </a>
                        
                         <!-- Nút xóa -->
       
            <button type="submit" style="border: none; background: none; color: red; cursor: pointer;">
                <i class="fa fa-trash"></i> Xóa
            </button>
       
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    
    <div class="table-container">

    </div>
</div>

<script>
    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".compact-table");
        tr = table.getElementsByTagName("tr");

        // Bắt đầu từ i = 1 để bỏ qua hàng tiêu đề
        for (i = 1; i < tr.length; i++) {
            // Lấy ô ID và Mô tả
            tdId = tr[i].getElementsByTagName("td")[0];
            tdDesc = tr[i].getElementsByTagName("td")[1];
            
            if (tdId || tdDesc) {
                txtId = tdId.textContent || tdId.innerText;
                txtDesc = tdDesc.textContent || tdDesc.innerText;

                if (txtId.toUpperCase().indexOf(filter) > -1 || 
                    txtDesc.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection