@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Chân Trang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Chân Trang</a></div>
                <div class="breadcrumb-item"><a href="#">Nội Dung Chân Trang</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.footer-grid-two.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Nội Dung Chân Trang</h2>
                    <p class="section-lead">Tuỳ chỉnh nội dung hiển thị trên chân trang.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chỉnh sửa nội dung</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.footer-grid-two.update', $footerGridTwo->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Hiển thị ở cột số</label>
                                            <select name="column" id="" class="form-control">
                                                <option value="">- - Chọn - -</option>
                                                <option {{ $footerGridTwo->column == 1 ? 'selected' : '' }} value="1">
                                                    Cột số
                                                    1</option>
                                                <option {{ $footerGridTwo->column == 2 ? 'selected' : '' }} value="2">
                                                    Cột số
                                                    2</option>
                                            </select>
                                            @if ($errors->has('column'))
                                                <p class="text-danger">{{ $errors->first('column') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Chính Sách Mua Hàng,..."
                                                value="{{ old('name', $footerGridTwo->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Đường dẫn</label>
                                            <input type="text" class="form-control" name="url"
                                                value="{{ old('url', $footerGridTwo->url) }}">
                                            @if ($errors->has('url'))
                                                <p class="text-danger">{{ $errors->first('url') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $footerGridTwo->status == 1 ? 'selected' : '' }} value="1">
                                                    Hiển thị</option>
                                                <option {{ $footerGridTwo->status == 0 ? 'selected' : '' }} value="0">
                                                    Không hiển thị</option>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('change', ".main-category", function(e) {
                let id = $(this).val()
                $.ajax({
                    url: "{{ route('admin.get-subcategories') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {

                        $('.sub-category').html('<option value="">- - Chọn - -</option>')

                        $.each(data, function(i, item) {
                            $(".sub-category").append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
