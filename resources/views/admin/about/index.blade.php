@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Website</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Website</a></div>
                <div class="breadcrumb-item"><a href="#">Giới Thiệu Trang Web</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.sub-category.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Giới Thiệu Trang Web</h2>
                    <p class="section-lead">Tuỳ chỉnh phần giới thiệu về trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h4>Tạo mới danh mục cấp 2</h4>
                                </div> --}}
                                <div class="card-body">
                                    <form action="{{ route('admin.about.update') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Nội dung giới thiệu</label>
                                            <textarea name="content" id="" class="editor">{{ @$about->content }}</textarea>
                                            @if ($errors->has('content'))
                                                <p class="text-danger">{{ $errors->first('content') }}</p>
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
