@extends('admin.layouts.master')

@section('content')
<h2>Thêm Menu</h2>
<form action="{{ route('admin.menu.store') }}" method="POST">
    @csrf
    <label>Tên Menu</label>
    <input type="text" name="title" class="form-control" required>
    <label>Link</label>
    <input type="text" name="url" class="form-control" required>
    <button type="submit" class="btn btn-success mt-3">Thêm</button>
</form>
@endsection
