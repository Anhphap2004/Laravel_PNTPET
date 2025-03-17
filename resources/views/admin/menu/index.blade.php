@extends('admin.layouts.master')

@section('content')
<div class="container d-flex flex-column align-items-center" style="max-width: 90%; margin: 0 auto;">
    <h2 class="my-4" style="color: #3a3a3a; font-weight: 700; text-align: center; position: relative; padding-bottom: 15px; margin-top: 2rem !important;">
        Danh sách Menu
        <span style="display: block; width: 100px; height: 3px; background: linear-gradient(90deg, #6c63ff, #b382ff); position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); border-radius: 10px;"></span>
    </h2>

    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-4" style="background: linear-gradient(90deg, #4e54c8, #8f94fb); border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; box-shadow: 0 4px 10px rgba(78, 84, 200, 0.3);">
        <i class="fas fa-plus-circle mr-2"></i> Thêm Menu
    </a>

    <div class="table-responsive" style="width: 90%; background: linear-gradient(145deg, #f6f8fa, #ffffff); border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); padding: 1.5rem; margin-bottom: 2rem;">
        <table class="table table-bordered text-center" style="border-radius: 10px; overflow: hidden; border-collapse: separate; border-spacing: 0; border: none;">
            <thead style="background: linear-gradient(90deg, #4e54c8, #8f94fb); color: white;">
                <tr>
                    <th style="border: none; padding: 1rem; font-weight: 600; border-top-left-radius: 10px;">ID</th>
                    <th style="border: none; padding: 1rem; font-weight: 600;">Tên Menu</th>
                    <th style="border: none; padding: 1rem; font-weight: 600;">Link</th>
                    <th style="border: none; padding: 1rem; font-weight: 600;">Vị Trí</th>
                    <th style="border: none; padding: 1rem; font-weight: 600;">Trạng Thái</th>
                    <th style="border: none; padding: 1rem; font-weight: 600; border-top-right-radius: 10px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr style="background-color: {{ $loop->even ? '#f8f9fa' : 'white' }}; transition: all 0.3s ease;">
                    <td style="border: 1px solid #e9ecef; padding: 12px;">{{ $menu->item_id }}</td>
                    <td style="border: 1px solid #e9ecef; padding: 12px; font-weight: 500;">{{ $menu->title }}</td>
                    <td style="border: 1px solid #e9ecef; padding: 12px;">{{ $menu->url }}</td>
                    <td style="border: 1px solid #e9ecef; padding: 12px;">{{ $menu->order_index }}</td>
                   <td style="border: 1px solid #e9ecef; padding: 12px; text-align: center;">
    @if($menu->status == 'active')
        <span style="display: inline-block; width: 22px; height: 22px; background-color: #2ecc71; border-radius: 50%; color: white; line-height: 22px; font-size: 14px;">
            <i class="fas fa-check" style="vertical-align: middle;"></i>
        </span>
    @else
        <span style="display: inline-block; width: 22px; height: 22px; background-color: #e74c3c; border-radius: 50%; color: white; line-height: 22px; font-size: 14px;">
            <i class="fas fa-times" style="vertical-align: middle;"></i>
        </span>
    @endif
</td>
                    <td style="border: 1px solid #e9ecef; padding: 12px;">
                        <a href="{{ route('admin.menu.edit', $menu->item_id) }}" class="btn btn-sm" style="background: linear-gradient(90deg, #ffa751, #ffe259); border: none; color: #333; font-weight: 600; margin-right: 5px; padding: 6px 12px; border-radius: 6px; box-shadow: 0 2px 5px rgba(255, 167, 81, 0.3);">
                            <i class="fas fa-edit mr-1"></i> Sửa
                        </a>
                        <form action="{{ route('admin.menu.destroy', $menu->item_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="background: linear-gradient(90deg, #ff6b6b, #ff8e8e); border: none; color: white; font-weight: 600; padding: 6px 12px; border-radius: 6px; box-shadow: 0 2px 5px rgba(255, 107, 107, 0.3);">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hiệu ứng hover cho các dòng
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        });

        row.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Hiệu ứng "lấp lánh" cho tiêu đề
    const title = document.querySelector('h2');
    setInterval(() => {
        title.style.textShadow = '0 0 10px rgba(108, 99, 255, 0.7)';
        setTimeout(() => {
            title.style.textShadow = 'none';
        }, 300);
    }, 3000);
});
</script>
@endsection
