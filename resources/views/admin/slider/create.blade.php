@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Website</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Website</a></div>
                <div class="breadcrumb-item"><a href="#">Slider</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.slider.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Slider</h2>
                    <p class="section-lead">Tuỳ chỉnh slider hiển thị trên trang chủ.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới slider</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.slider.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Hình ảnh slider</label>
                                            <input type="file" class="form-control" name="banner">
                                            @if ($errors->has('banner'))
                                                <p class="text-danger">{{ $errors->first('banner') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Thể loại slider</label>
                                            <input type="text" class="form-control" name="type"
                                                placeholder="Ví dụ: New Collections" value="{{ old('type') }}">
                                            @if ($errors->has('type'))
                                                <p class="text-danger">{{ $errors->first('type') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề slider</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Ví dụ: Bộ sưu tập hè..." value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <p class="text-danger">{{ $errors->first('title') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giá khởi điểm</label>
                                            <input type="text" class="form-control" name="starting_price"
                                                placeholder="Ví dụ: 500.000đ" value="{{ old('starting_price') }}">
                                            @if ($errors->has('starting_price'))
                                                <p class="text-danger">{{ $errors->first('starting_price') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Đường link dẫn đến khi nhấn nút</label>
                                            <input type="text" class="form-control" name="btn_url"
                                                placeholder="Ví dụ: http://megamart.com/new-collections..."
                                                value="{{ old('btn_url') }}">
                                            @if ($errors->has('btn_url'))
                                                <p class="text-danger">{{ $errors->first('btn_url') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Thứ tự hiển thị</label>
                                            <input type="text" class="form-control" name="serial"
                                                placeholder="Ví dụ: 1 hoặc 2 hoặc 3..." value="{{ old('serial') }}">
                                            @if ($errors->has('serial'))
                                                <p class="text-danger">{{ $errors->first('serial') }}</p>
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
