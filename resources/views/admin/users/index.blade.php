@extends('admin.layouts.master')

@section('content')
<style>
    /* Fix sidebar overlap issue */
    .content-wrapper {
        margin-left: 230px; /* Push content right to avoid sidebar overlap */
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

    .badge-info {
        background-color: #d1ecf1;
        color: #0c5460;
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

    /* User profile image */
    .user-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
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
</style>

<div class="content-wrapper">
    <div class="page-intro">
        <h4>Quản lý danh sách người dùng hệ thống</h4>
        <p>Cập nhật thông tin, phân quyền và kiểm soát trạng thái người dùng.</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h5>Danh sách người dùng</h5>
            <div>
                <a href="#" class="btn-outline-secondary" id="exportExcel">
                    <i class="fa fa-download"></i> Xuất Excel
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn-primary">
                    <i class="fa fa-plus-circle"></i> Thêm mới
                </a>
            </div>
        </div>
        
        <div>
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm người dùng..." onkeyup="filterTable()">
        </div>
        
        <table class="compact-table">
            <thead>
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Vai trò</th>
                    <th>Ảnh đại diện</th>
                    <th>Ngày tạo</th>
                    <th>Cập nhật</th>
                    <th>Đăng nhập cuối</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>
                        <div style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $user->full_name }}
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <div style="max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $user->address }}
                        </div>
                    </td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge badge-primary">Admin</span>
                        @else
                            <span class="badge badge-info">Customer</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($user->profile_image)
                            <img src="{{ asset('img/Owners/' . $user->profile_image) }}" alt="Ảnh đại diện" class="user-img">
                        @else
                            <div class="user-img" style="background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                <span style="color: #666;">{{ substr($user->full_name ?? $user->username, 0, 1) }}</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->last_login }}</td>
                    <td>
                        @if($user->status == 1)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-secondary">Khóa</span>
                        @endif
                    </td>
                    <td class="action-links">
                        <a href="{{ route('admin.users.edit', ['id' => $user->user_id]) }}" title="Chỉnh sửa">
                            <i class="fa fa-edit"></i>
                        </a>
                        
                        <a href="{{ route('admin.users.show', $user) }}" title="Chi tiết">
                            <i class="fa fa-eye"></i>
                        </a>
                        
                        
                        <!-- Xóa người dùng -->
           <!-- Form xóa người dùng -->
           <form action="{{ route('admin.users.destroy', ['id' => $user->user_id]) }}" 
            method="POST" 
            style="display:inline-block;" 
            onsubmit="return confirm('Bạn có chắc muốn xoá người dùng này không?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa fa-trash"></i> Xoá
          </button>
      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="table-footer">
            <div>Hiển thị <span class="font-weight-bold">1-{{ count($users) }}</span> của <span class="font-weight-bold">{{ count($users) }}</span> bản ghi</div>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
        </div>
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
            // Lấy ô tên đăng nhập (index 0) và họ tên (index 1)
            tdUsername = tr[i].getElementsByTagName("td")[0];
            tdFullname = tr[i].getElementsByTagName("td")[1];
            tdEmail = tr[i].getElementsByTagName("td")[2];
            
            if (tdUsername || tdFullname || tdEmail) {
                txtUsername = tdUsername.textContent || tdUsername.innerText;
                txtFullname = tdFullname.textContent || tdFullname.innerText;
                txtEmail = tdEmail.textContent || tdEmail.innerText;

                if (txtUsername.toUpperCase().indexOf(filter) > -1 || 
                    txtFullname.toUpperCase().indexOf(filter) > -1 ||
                    txtEmail.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection