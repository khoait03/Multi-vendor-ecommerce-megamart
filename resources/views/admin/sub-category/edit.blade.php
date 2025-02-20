@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Danh Mục</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Danh Mục</a></div>
                <div class="breadcrumb-item"><a href="#">Danh Mục Cấp 2</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.sub-category.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Danh mục cấp 2</h2>
                    <p class="section-lead">Tuỳ chỉnh danh mục cấp 2 hiển thị trên trang chủ.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chỉnh sửa danh mục cấp 2</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.sub-category.update', $subCategory->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Thuộc danh mục cấp 1</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option value="">- - Chọn - -</option>

                                                @foreach ($categories as $category)
                                                    <option
                                                        {{ $category->id == $subCategory->category_id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Điện thoại, Laptop,..."
                                                value="{{ old('name', $subCategory->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $subCategory->status == '1' ? 'selected' : '' }} value="1">
                                                    Hiển
                                                    thị
                                                </option>
                                                <option {{ $subCategory->status == '0' ? 'selected' : '' }} value="0">
                                                    Không
                                                    hiển
                                                    thị
                                                </option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

        </div>
    </section>
@endsection
