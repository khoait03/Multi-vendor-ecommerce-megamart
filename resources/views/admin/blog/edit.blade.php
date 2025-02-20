@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Bài Viết</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Bài Viết</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.blog.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Quản Lý Bài Viết</h2>
                    <p class="section-lead">Tuỳ chỉnh bài viết hiển thị trên web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chỉnh sửa bài viết</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Hình ảnh bài viết</label>
                                            <br>
                                            <img src="{{ asset($blog->image) }}" alt="" width="150px">
                                            <input type="file" class="form-control mt-3" name="image">
                                            @if ($errors->has('image'))
                                                <p class="text-danger">{{ $errors->first('image') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề bài viết</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Ví dụ: Tin tức mùa hè,..."
                                                value="{{ old('title', $blog->title) }}">
                                            @if ($errors->has('title'))
                                                <p class="text-danger">{{ $errors->first('title') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Danh mục bài viết</label>
                                            <input type="text" class="form-control" name="category"
                                                placeholder="Ví dụ: Tin công nghệ, mẹo vặt,..."
                                                value="{{ old('category', $blog->category) }}">
                                            @if ($errors->has('category'))
                                                <p class="text-danger">{{ $errors->first('category') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Nội dung bài viết</label>
                                            <textarea name="description" class="form-control editor">{{ $blog->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $blog->status == 1 ? 'selected' : '' }} value="1">Hiển thị
                                                </option>
                                                <option {{ $blog->status == 0 ? 'selected' : '' }} value="0">Không
                                                    hiển thị
                                                </option>
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
