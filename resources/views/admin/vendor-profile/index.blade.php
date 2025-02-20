@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Bán Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Bán Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Thông Tin Gian Hàng</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.slider.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Thông Tin Gian Hàng</h2>
                    <p class="section-lead">Tuỳ chỉnh thông tin gian hàng của MegaMart.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h4>Tạo mới slider</h4>
                                </div> --}}
                                <div class="card-body">
                                    <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Hình ảnh nền của gian hàng</label>
                                            <br>
                                            <img src="{{ asset($profile->banner) }}" width="200px" alt="">
                                            <input type="file" class="form-control mt-3" name="banner">
                                            @if ($errors->has('banner'))
                                                <p class="text-danger">{{ $errors->first('banner') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên gian hàng</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: MegaMart" value="{{ old('name', $profile->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Điện thoại</label>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Ví dụ: 0123456789" value="{{ old('phone', $profile->phone) }}">
                                            @if ($errors->has('phone'))
                                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Ví dụ: abc@gmail.com"
                                                value="{{ old('email', $profile->email) }}">
                                            @if ($errors->has('email'))
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Ví dụ: 3/2, Ninh Kiều, Cần Thơ"
                                                value="{{ old('address', $profile->address) }}">
                                            @if ($errors->has('address'))
                                                <p class="text-danger">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="editor" name="description">
                                              {{ $profile->description }}
                                            </textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" name="fb_link"
                                                value="{{ old('fb_link', $profile->fb_link) }}">
                                            @if ($errors->has('fb_link'))
                                                <p class="text-danger">{{ $errors->first('fb_link') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" name="tw_link"
                                                value="{{ old('tw_link', $profile->tw_link) }}">
                                            @if ($errors->has('tw_link'))
                                                <p class="text-danger">{{ $errors->first('tw_link') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input type="text" class="form-control" name="insta_link"
                                                value="{{ old('insta_link', $profile->insta_link) }}">
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
    </section>
@endsection
