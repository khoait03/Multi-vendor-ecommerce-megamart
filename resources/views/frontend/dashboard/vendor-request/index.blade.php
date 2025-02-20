@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Yêu Cầu
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content">
                <h3><i class="fal fa-user-plus"></i> Đăng Ký Trở Thành Gian Hàng</h3>
                @if ($vendor && $vendor->status == 0)
                    <div class="p-3 bg-success rounded mb-3 shadow-sm">
                        <p class="text-white">Vui lòng chờ quản trị viên xét duyệt!</p>
                    </div>
                @endif
                <div class="wsus__dashboard_add">
                    <div class="row">
                        <h5 class="fw-bold mb-3">Điều khoản trở thành gian hàng của MegaMart</h5>
                        {!! @$condition->content !!}
                    </div>
                </div>
                <div class="wsus__dashboard_add mt-3">
                    <div class="row">

                        <form action="{{ route('user.vendor-request.create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold h6">Hình ảnh nền của gian hàng</label>
                                <br>
                                <img src="{{ asset(@$vendor->banner) }}" alt="" width="200px">
                                <input type="file" name="shop_image" class="form-control mt-3" placeholder="Họ và tên">
                                @if ($errors->has('shop_image'))
                                    <p class="text-danger">{{ $errors->first('shop_image') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold h6">Tên gian hàng</label>
                                <input type="text" name="shop_name" class="form-control" placeholder="ABC Shop,..."
                                    value="{{ old('shop_name', @$vendor->name) }}">
                                @if ($errors->has('shop_name'))
                                    <p class="text-danger">{{ $errors->first('shop_name') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold h6">Email</label>
                                        <input type="text" name="shop_email" class="form-control"
                                            placeholder="example@gmail.com"
                                            value="{{ old('shop_email', @$vendor->email) }}">
                                        @if ($errors->has('shop_email'))
                                            <p class="text-danger">{{ $errors->first('shop_email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold h6">Số điện thoại</label>
                                        <input type="text" name="shop_phone" class="form-control"
                                            placeholder="0123456789" value="{{ old('shop_phone', @$vendor->phone) }}">
                                        @if ($errors->has('shop_phone'))
                                            <p class="text-danger">{{ $errors->first('shop_phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold h6">Địa chỉ</label>
                                <input type="text" name="shop_address" class="form-control"
                                    placeholder="Địa chỉ của shop..." value="{{ old('shop_address', @$vendor->address) }}">
                                @if ($errors->has('shop_address'))
                                    <p class="text-danger">{{ $errors->first('shop_address') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold">Giới thiệu chi tiết về gian hàng</label>
                                <textarea class="editor" name="shop_description">{{ old('shop_description', @$vendor->description) }}</textarea>
                                @if ($errors->has('shop_description'))
                                    <p class="text-danger">{{ $errors->first('shop_description') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Xác nhận</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
