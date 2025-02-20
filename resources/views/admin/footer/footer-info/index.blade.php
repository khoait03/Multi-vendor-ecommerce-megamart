@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Chân Trang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Chân Trang</a></div>
                <div class="breadcrumb-item"><a href="#">Thông tin liên hệ</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Thông tin liên hệ</h2>
            <p class="section-lead">Tuỳ chỉnh thông tin liên hệ hiển thị trên chân trang.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4>Tạo mới danh mục cấp 1</h4>
                        </div> --}}
                        <div class="card-body">
                            <form action="{{ route('admin.footer-info.update', 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Logo</label>
                                    <br>
                                    <img src="{{ asset($footerInfo->logo) }}" alt="" width="150px">
                                    <input type="file" class="form-control mt-3" name="logo">
                                    @if ($errors->has('logo'))
                                        <p class="text-danger">{{ $errors->first('logo') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Điện thoại liên hệ</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', $footerInfo->phone) }}">
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email', $footerInfo->email) }}">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ old('address', $footerInfo->address) }}">
                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
