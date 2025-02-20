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
            <a
                href="{{ route('admin.product-variant-item.index', ['product' => $product->id, 'variant' => $variant->id]) }}">
                < Quay lại</a>
                    <h2 class="section-title">Thành Phần Của Biến Thể <span
                            class="text-primary h5">{{ $variant->name }}</span> Của Sản Phẩm <span
                            class="text-primary h5">{{ $product->name }}</span>
                    </h2>
                    <p class="section-lead">Tuỳ chỉnh các thành phần của biến thể của sản phẩm có trong trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chỉnh sửa thành phần của biến thể</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.product-variant-item.update', $variantItem->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Tên biến thể</label>
                                            <input type="text" class="form-control" name="variant_name"
                                                value="{{ $variant->name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="variant_id"
                                                value="{{ $variant->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tên thành phần</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Màu sắc: Đen, trắng, xanh,..."
                                                value="{{ old('name', $variantItem->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giá bán cộng thêm (Nhập 0 nếu thành phần này là miễn phí của biến thể của
                                                sản phẩm)</label>
                                            <input type="number" class="form-control" name="price"
                                                placeholder="Ví dụ: 0 hoặc 1000000,..."
                                                value="{{ old('price', $variantItem->price) }}">
                                            @if ($errors->has('price'))
                                                <p class="text-danger">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Được chọn làm mặc định ?</label>
                                            <select name="is_default" id="" class="form-control">
                                                <option value="">- - Chọn - -</option>
                                                <option {{ $variantItem->is_default == 1 ? 'selected' : '' }}
                                                    value="1">Có
                                                </option>
                                                <option {{ $variantItem->is_default == 0 ? 'selected' : '' }}
                                                    value="0">
                                                    Không
                                                </option>
                                            </select>
                                            @if ($errors->has('is_default'))
                                                <p class="text-danger">{{ $errors->first('is_default') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">
                                                    Hiển
                                                    thị</option>
                                                <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">
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
