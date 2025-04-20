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
        text-decoration: none;
        display: inline-block;
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

    .badge-warning {
        background-color: #fff3cd;
        color: #856404;
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

    /* Animal image */
    .animal-img {
        width: 60px;
        height: 60px;
        border-radius: 4px;
        object-fit: cover;
    }

    /* Action links */
    .action-links {
        white-space: nowrap;
    }

    .action-links a, .action-links button {
        display: inline-block;
        margin: 0 3px;
        padding: 4px 6px;
        border-radius: 4px;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
    }

    .action-links a:hover, .action-links button:hover {
        background-color: #f0f0f0;
    }

    .action-links .fa-eye {
        color: #1a3b5d;
    }

    .action-links .fa-edit {
        color: #ffc107;
    }

    .action-links .fa-trash {
        color: #dc3545;
    }

    /* Alert message */
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
        <h4>Danh sách động vật</h4>
        <p>Quản lý thông tin chi tiết về động vật trong hệ thống.</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h5>Danh sách động vật</h5>
            <div>
                <a href="#" class="btn-outline-secondary" id="exportExcel">
                    <i class="fa fa-download"></i> Xuất Excel
                </a>
                <a href="{{ route('admin.animals.create') }}" class="btn-primary">
                    <i class="fa fa-plus-circle"></i> Thêm mới
                </a>
            </div>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        <div>
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm động vật..." onkeyup="filterTable()">
        </div>
        
        <table class="compact-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Loài</th>
                    <th>Giống</th>
                    <th>Giới tính</th>
                    <th>Tuổi</th>
                    <th>Cân nặng (kg)</th>
                    <th>Chiều cao (cm)</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Người quản lý</th>
                    <th>Ngày vào</th>
                    <th>Ngày ra</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($animals as $key => $animal)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $animal->name }}</td>
                    <td>{{ $animal->category_id }}</td>
                    <td>{{ $animal->breed }}</td>
                    <td>
                        @if($animal->gender == 'male')
                            <span class="badge badge-primary">Đực</span>
                        @else
                            <span class="badge badge-info">Cái</span>
                        @endif
                    </td>
                    <td>{{ $animal->age }}</td>
                    <td>{{ $animal->weight }}</td>
                    <td>{{ $animal->height }}</td>
                    <td>
                        @if($animal->image)
                            <img src="{{ asset('img/Animal/' . $animal->image) }}" class="animal-img" alt="{{ $animal->name }}">
                        @else
                            <div class="animal-img d-flex align-items-center justify-content-center" style="background-color: #e9ecef; text-align: center;">
                                <span style="color: #666;">N/A</span>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($animal->status == 'active')
                            <span class="badge badge-success">Hoạt động</span>
                        @elseif($animal->status == 'inactive')
                            <span class="badge badge-secondary">Không hoạt động</span>
                        @elseif($animal->status == 'pending')
                            <span class="badge badge-warning">Chờ xử lý</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($animal->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $animal->user_id }}</td>
                    <td>{{ $animal->entry_date }}</td>
                    <td>{{ $animal->exit_date ?? '---' }}</td>
                    <td class="action-links">
                        <a href="{{ route('admin.animals.show', $animal->animal_id) }}" title="Xem chi tiết">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.animals.edit', $animal->animal_id) }}" title="Chỉnh sửa">
                            <i class="fa fa-edit"></i>
                        </a>
                       <!-- Nút xóa -->
        <form action="{{ route('admin.animals.destroy', $animal->animal_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="border: none; background: none; color: red; cursor: pointer;">
                <i class="fa fa-trash"></i> Xóa
            </button>
        </form>
                    </td>
                </tr>
                @endforeach
                
                @if($animals->isEmpty())
                <tr>
                    <td colspan="14" style="text-align: center; padding: 20px;">
                        <i class="fa fa-info-circle" style="font-size: 24px; color: #6c757d; margin-bottom: 10px; display: block;"></i>
                        <p style="color: #6c757d; margin: 0;">Không có dữ liệu động vật nào.</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <div class="table-footer">
            <div>Hiển thị <span style="font-weight: 600;">1-{{ count($animals) }}</span> của <span style="font-weight: 600;">{{ count($animals) }}</span> bản ghi</div>
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
            // Tìm kiếm theo tên (cột thứ 1) và loài (cột thứ 2)
            tdName = tr[i].getElementsByTagName("td")[1];
            tdSpecies = tr[i].getElementsByTagName("td")[2];
            tdBreed = tr[i].getElementsByTagName("td")[3];
            
            if (tdName || tdSpecies || tdBreed) {
                txtName = tdName.textContent || tdName.innerText;
                txtSpecies = tdSpecies.textContent || tdSpecies.innerText;
                txtBreed = tdBreed.textContent || tdBreed.innerText;

                if (txtName.toUpperCase().indexOf(filter) > -1 || 
                    txtSpecies.toUpperCase().indexOf(filter) > -1 ||
                    txtBreed.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection