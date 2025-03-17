@extends('admin.layouts.master')

@section('content')
<div class="container" style="max-width: 500px; margin: 0 auto;">
    <div style="background: linear-gradient(145deg, #f6f8fa, #ffffff); border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); padding: 1.5rem; margin: 1.5rem auto;">
        <h2 style="color: #3a3a3a; font-weight: 600; text-align: center; margin-bottom: 1.2rem; position: relative; padding-bottom: 10px; font-size: 1.5rem;">
            Sửa Menu
            <span style="display: block; width: 60px; height: 2px; background: linear-gradient(90deg, #6c63ff, #b382ff); position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); border-radius: 10px;"></span>
        </h2>

        <form action="{{ route('admin.menu.update', $menus->item_id) }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 500; color: #444; margin-bottom: 5px; font-size: 0.9rem;">Tên Menu</label>
                <input type="text" name="title" value="{{ $menus->title }}" required
                    style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; transition: all 0.2s; font-size: 14px; background-color: #f9fafc;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 500; color: #444; margin-bottom: 5px; font-size: 0.9rem;">Link</label>
                <input type="text" name="url" value="{{ $menus->url }}" required
                    style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; transition: all 0.2s; font-size: 14px; background-color: #f9fafc;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; font-weight: 500; color: #444; margin-bottom: 5px; font-size: 0.9rem;">Thứ tự hiển thị</label>
                <input type="number" name="order_index" value="{{ $menus->order_index }}" required
                    style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; transition: all 0.2s; font-size: 14px; background-color: #f9fafc;">
            </div>

            <!-- Checkbox Status -->
            <div style="margin-bottom: 1.2rem; padding: 10px; background-color: #f8f9fa; border-radius: 6px; border-left: 3px solid #6c63ff;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="status" id="statusCheckbox" {{ $menus->status === 'active' ? 'checked' : '' }}
                        style="margin-right: 8px; accent-color: #6c63ff;">
                    <span style="font-weight: 500; color: #444; font-size: 14px;">Kích hoạt Menu</span>
                </label>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 0.8rem;">
                <a href="{{ route('admin.menu.index') }}" style="flex: 1; padding: 8px 12px; background-color: #f1f1f1; color: #444; text-align: center; border-radius: 6px; font-weight: 500; text-decoration: none; font-size: 14px;">
                    Quay lại
                </a>
                <button type="submit" style="flex: 2; padding: 8px 12px; background: linear-gradient(90deg, #4e54c8, #8f94fb); color: white; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; font-size: 14px;">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
