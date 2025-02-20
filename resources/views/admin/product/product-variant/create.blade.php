@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Thư Viện Biến Thể</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.product-variant.index', ['product' => $product->id]) }}">
                < Quay lại</a>
                    <h2 class="section-title">Thêm Biến Thể Cho Sản Phẩm <span
                            class="text-primary h5">{{ $product->name }}</span></h2>
                    <p class="section-lead">Tuỳ chỉnh danh mục cấp 1 hiển thị trên trang chủ.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới biến thể</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.product-variant.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Tên biến thể</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Màu sắc, kích cỡ,..." value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="product" value="{{ $product->id }}">
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
