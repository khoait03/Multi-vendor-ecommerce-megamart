@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.product-variant.index', ['product' => $product->id]) }}"
                    class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-plus"></i> Thêm mới biến thể cho sản phẩm <u
                        style="margin: 0 10px; color: green">{{ $product->name }}</u></h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">


                        <div class="row">

                            <div class="card-body">
                                <form action="{{ route('vendor.product-variant.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tên biến thể</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ví dụ: Màu sắc, kích cỡ,..." value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="product" value="{{ $product->id }}">
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
