@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Thương Hiệu</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.brand.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Thương Hiệu</h2>
                    <p class="section-lead">Tuỳ chỉnh thương hiệu của sản phẩm.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới thương hiệu</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.brand.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Hình ảnh thương hiệu</label>
                                            <input type="file" class="form-control" name="logo">
                                            @if ($errors->has('logo'))
                                                <p class="text-danger">{{ $errors->first('logo') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên thương hiệu</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Samsung, Dell, Asus,..." value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Hiển thị thương hiệu nổi bật ở trang chủ ?</label>
                                            <select name="is_featured" id="" class="form-control">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                            @if ($errors->has('is_featured'))
                                                <p class="text-danger">{{ $errors->first('is_featured') }}</p>
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
