@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Danh Mục</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Danh Mục</a></div>
                <div class="breadcrumb-item"><a href="#">Danh Mục Cấp 3</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.child-category.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Danh mục cấp 3</h2>
                    <p class="section-lead">Tuỳ chỉnh danh mục cấp 3 hiển thị trên trang chủ.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới danh mục cấp 3</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.child-category.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Thuộc danh mục cấp 1</label>
                                            <select name="category_id" id="" class="form-control main-category">
                                                <option value="">- - Chọn - -</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Thuộc danh mục cấp 2</label>
                                            <select name="sub_category_id" id="" class="form-control sub-category">
                                                <option value="">- - Chọn - -</option>

                                                {{-- @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach --}}
                                            </select>
                                            @if ($errors->has('sub_category_id'))
                                                <p class="text-danger">{{ $errors->first('sub_category_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Điện thoại, Laptop,..." value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
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
