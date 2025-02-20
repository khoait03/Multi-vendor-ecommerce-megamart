@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.product-variant-item.index', ['product' => $product->id, 'variant' => $variant->id]) }}"
                    class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-plus"></i> Thêm mới thành phần của biến thể {{ $variant->name }} của sản phẩm
                    {{ $product->name }}</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">


                        <div class="row">

                            <div class="card-body">
                                <form action="{{ route('vendor.product-variant-item.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tên biến thể</label>
                                        <input type="text" class="form-control" name="variant_name"
                                            value="{{ $variant->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="variant_id"
                                            value="{{ $variant->id }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tên thành phần</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ví dụ: Màu sắc: Đen, trắng, xanh,..." value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Giá bán cộng thêm (Nhập 0 nếu thành phần này là miễn phí
                                            của biến thể của
                                            sản phẩm)</label>
                                        <input type="number" class="form-control" name="price"
                                            placeholder="Ví dụ: 0 hoặc 1000000,..." value="{{ old('price') }}">
                                        @if ($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Được chọn làm mặc định ?</label>
                                        <select name="is_default" id="" class="form-control">
                                            <option value="">- - Chọn - -</option>
                                            <option value="1">Có</option>
                                            <option value="0">Không</option>
                                        </select>
                                        @if ($errors->has('is_default'))
                                            <p class="text-danger">{{ $errors->first('is_default') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Trạng thái</label>
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
        </div>
    </div>
@endsection
