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

    /* Blog image */
    .blog-img {
        width: 80px;
        height: 50px;
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
        <h4>Danh sách bài viết</h4>
        <p>Quản lý các bài viết và tin tức trong hệ thống.</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h5>Danh sách bài viết</h5>
            <div>
                <a href="#" class="btn-outline-secondary" id="exportExcel">
                    <i class="fa fa-download"></i> Xuất Excel
                </a>
                <a href="{{ route('admin.blogs.create') }}" class="btn-primary">
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
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm bài viết..." onkeyup="filterTable()">
        </div>
        
        <table class="compact-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Lượt xem</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $key => $blog)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $blog->post_id }}</td>
                    <td>
                        @if($blog->featured_image)
                            <img src="{{ asset('img/Blog/' . $blog->featured_image) }}" class="blog-img" alt="{{ $blog->title }}">
                        @else
                            <div class="blog-img d-flex align-items-center justify-content-center" style="background-color: #e9ecef; text-align: center;">
                                <span style="color: #666;">N/A</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>
                        @if($blog->status == 'published')
                            <span class="badge badge-success">Đã đăng</span>
                        @elseif($blog->status == 'draft')
                            <span class="badge badge-secondary">Bản nháp</span>
                        @elseif($blog->status == 'pending')
                            <span class="badge badge-warning">Chờ duyệt</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($blog->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $blog->view_count }}</td>
                    <td>{{ $blog->publish_date }}</td>
                    <td class="action-links">
                        <a href="{{ route('admin.blogs.show', $blog->post_id) }}" title="Xem chi tiết">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.blogs.edit', $blog->post_id) }}" title="Chỉnh sửa">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.blogs.destroy', $blog->post_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                
                @if($blogs->isEmpty())
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px;">
                        <i class="fa fa-info-circle" style="font-size: 24px; color: #6c757d; margin-bottom: 10px; display: block;"></i>
                        <p style="color: #6c757d; margin: 0;">Không có bài viết nào.</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <div class="table-footer">
            <div>Hiển thị <span style="font-weight: 600;">{{ $blogs->firstItem() ?? 0 }}-{{ $blogs->lastItem() ?? 0 }}</span> của <span style="font-weight: 600;">{{ $blogs->total() ?? 0 }}</span> bản ghi</div>
            <div>
                {{ $blogs->links() }}
            </div>
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
            // Tìm kiếm theo tiêu đề (cột thứ 3) và slug (cột thứ 4)
            tdTitle = tr[i].getElementsByTagName("td")[3];
            tdSlug = tr[i].getElementsByTagName("td")[4];
            
            if (tdTitle || tdSlug) {
                txtTitle = tdTitle ? tdTitle.textContent || tdTitle.innerText : "";
                txtSlug = tdSlug ? tdSlug.textContent || tdSlug.innerText : "";

                if (txtTitle.toUpperCase().indexOf(filter) > -1 || 
                    txtSlug.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection