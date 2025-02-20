@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Danh Mục</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Danh Mục</a></div>
                <div class="breadcrumb-item"><a href="#">Danh Mục Cấp 1</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.category.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Danh mục cấp 1</h2>
                    <p class="section-lead">Tuỳ chỉnh danh mục cấp 1 hiển thị trên trang chủ.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới danh mục cấp 1</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.category.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Icon</label>
                                            <br>
                                            <button class="btn btn-primary" name="icon" role="iconpicker"
                                                data-selected-class="btn-danger"
                                                data-unselected-class="btn-primary"></button>
                                            @if ($errors->has('icon'))
                                                <p class="text-danger">{{ $errors->first('icon') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Điện thoại, Laptop,..." value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

        </div>
    </section>
@endsection
