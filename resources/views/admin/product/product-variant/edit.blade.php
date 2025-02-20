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
            <a href="{{ route('admin.product-variant.index', ['product' => $productVariant->product_id]) }}">
                < Quay lại</a>
                    <h2 class="section-title">Chỉnh Sửa Biến Thể <span
                            class="text-primary h5">{{ $productVariant->name }}</span> Cho Sản Phẩm <span
                            class="text-primary h5">{{ $product->name }}</span></h2>
                    <p class="section-lead">Tuỳ chỉnh các biến thể của sản phẩm có trong trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới biến thể</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.product-variant.update', $productVariant->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Tên biến thể</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Màu sắc, kích cỡ,..."
                                                value="{{ old('name', $productVariant->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $productVariant->status == 1 ? 'selected' : '' }} value="1">
                                                    Hiển
                                                    thị</option>
                                                <option {{ $productVariant->status == 0 ? 'selected' : '' }} value="0">
                                                    Không
                                                    hiển thị</option>
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
