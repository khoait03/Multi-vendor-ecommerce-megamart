@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Thông tin
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-hotel"></i> Thông tin gian hàng</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="row">

                            <div class="card-body">
                                <form action="{{ route('vendor.shop-profile.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Hình ảnh nền của gian hàng</label>
                                        <br>
                                        <img src="{{ $profile ? asset($profile->banner) : '' }}" width="200px"
                                            alt="">
                                        <input type="file" class="form-control mt-3" name="banner">
                                        @if ($errors->has('banner'))
                                            <p class="text-danger">{{ $errors->first('banner') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tên gian hàng</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ví dụ: MegaMart"
                                            value="{{ old('name', $profile ? $profile->name : '') }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Điện thoại</label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Ví dụ: 0123456789"
                                            value="{{ old('phone', $profile ? $profile->phone : '') }}">
                                        @if ($errors->has('phone'))
                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            placeholder="Ví dụ: abc@gmail.com"
                                            value="{{ old('email', $profile ? $profile->email : '') }}">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Ví dụ: 3/2, Ninh Kiều, Cần Thơ"
                                            value="{{ old('address', $profile ? $profile->address : '') }}">
                                        @if ($errors->has('address'))
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Mô tả</label>
                                        <textarea class="editor" name="description">
                                        {{ $profile ? $profile->description : '' }}
                                      </textarea>
                                        @if ($errors->has('description'))
                                            <p class="text-danger">{{ $errors->first('description') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Facebook</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ old('fb_link', $profile ? $profile->fb_link : '') }}">
                                        @if ($errors->has('fb_link'))
                                            <p class="text-danger">{{ $errors->first('fb_link') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Twitter</label>
                                        <input type="text" class="form-control" name="tw_link"
                                            value="{{ old('tw_link', $profile ? $profile->tw_link : '') }}">
                                        @if ($errors->has('tw_link'))
                                            <p class="text-danger">{{ $errors->first('tw_link') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Instagram</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ old('insta_link', $profile ? $profile->insta_link : '') }}">
                                        @if ($errors->has('insta_link'))
                                            <p class="text-danger">{{ $errors->first('insta_link') }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
