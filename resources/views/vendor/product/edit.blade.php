@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.products.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3 class="d-flex">
                    <i class="far fa-pen"></i>
                    Chỉnh sửa sản phẩm
                    {{ $product->name }}
                </h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">


                        <div class="row">

                            <div class="card-body">
                                <form action="{{ route('vendor.products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Ảnh đại diện của sản phẩm</label>
                                        <br>
                                        <img src="{{ asset($product->thumb_image) }}" width="150px" alt="">
                                        <input type="file" class="form-control mt-3" name="thumb_image">
                                        @if ($errors->has('thumb_image'))
                                            <p class="text-danger">{{ $errors->first('thumb_image') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ví dụ: Iphone 15" value="{{ old('name', $product->name) }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 fw-bold">Danh mục cấp 1</label>
                                                <select name="category" id="" class="form-control main-category">
                                                    <option value="">- - Chọn - -</option>

                                                    @foreach ($categories as $category)
                                                        <option
                                                            {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('category'))
                                                    <p class="text-danger">{{ $errors->first('category') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 fw-bold">Danh mục cấp 2</label>
                                                <select name="sub_category" id=""
                                                    class="form-control sub-category">
                                                    <option value="">- - Chọn - -</option>

                                                    @foreach ($subCategories as $subCategory)
                                                        <option
                                                            {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}
                                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('sub_category'))
                                                    <p class="text-danger">{{ $errors->first('sub_category') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 fw-bold">Danh mục cấp 3</label>
                                                <select name="child_category" id=""
                                                    class="form-control child-category">
                                                    <option value="">- - Chọn - -</option>

                                                    @foreach ($childCategories as $childCategory)
                                                        <option
                                                            {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}
                                                            value="{{ $childCategory->id }}">
                                                            {{ $childCategory->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('child_category'))
                                                    <p class="text-danger">{{ $errors->first('child_category') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Thương hiệu</label>
                                        <select name="brand" id="" class="form-control">
                                            <option value="">- - Chọn - -</option>

                                            @foreach ($brands as $brand)
                                                <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('brand'))
                                            <p class="text-danger">{{ $errors->first('brand') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Mã sản phẩm (SKU)</label>
                                        <input type="text" class="form-control" name="sku"
                                            placeholder="Ví dụ: ABC123" value="{{ old('sku', $product->sku) }}">
                                        @if ($errors->has('sku'))
                                            <p class="text-danger">{{ $errors->first('sku') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Giá gốc của sản phẩm (VNĐ)</label>
                                        <input type="text" class="form-control" name="price"
                                            placeholder="Ví dụ: 15000000" value="{{ old('price', $product->price) }}">
                                        @if ($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Giá bán thực tế của sản phẩm (VNĐ)</label>
                                        <input type="text" class="form-control" name="offer_price"
                                            placeholder="Ví dụ: 15000000"
                                            value="{{ old('offer_price', $product->offer_price) }}">
                                        @if ($errors->has('offer_price'))
                                            <p class="text-danger">{{ $errors->first('offer_price') }}</p>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 fw-bold">Ngày bắt đầu giảm giá</label>
                                                <input type="text" name="offer_start_date"
                                                    class="form-control datepicker"
                                                    value="{{ old('offer_start_date', $product->offer_start_date) }}">
                                                @if ($errors->has('offer_start_date'))
                                                    <p class="text-danger">{{ $errors->first('offer_start_date') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 fw-bold">Ngày kết thúc giảm giá</label>
                                                <input type="text" name="offer_end_date"
                                                    class="form-control datepicker"
                                                    value="{{ old('offer_end_date', $product->offer_end_date) }}">
                                                @if ($errors->has('offer_end_date'))
                                                    <p class="text-danger">{{ $errors->first('offer_end_date') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Số lượng sản phẩm trong kho</label>
                                        <input type="number" min="0" class="form-control" name="quantity"
                                            placeholder="Ví dụ: 1 hoặc 2 hoặc 3..."
                                            value="{{ old('quantity', $product->quantity) }}">
                                        @if ($errors->has('quantity'))
                                            <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Video giới thiệu sản phẩm (Nếu có)</label>
                                        <input type="text" class="form-control" name="video_link"
                                            placeholder="Ví dụ: https://www.youtube.com/watch?v=UYXz1j0RUWQ"
                                            value="{{ old('video_link', $product->video_link) }}">
                                        @if ($errors->has('video_link'))
                                            <p class="text-danger">{{ $errors->first('video_link') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Giới thiệu tóm tắt về sản phẩm (0-200
                                            chữ)</label>
                                        <textarea class="form-control" name="short_description">{!! $product->short_description !!}</textarea>
                                        @if ($errors->has('short_description'))
                                            <p class="text-danger">{{ $errors->first('short_description') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Giới thiệu chi tiết về sản phẩm</label>
                                        <textarea class="editor" name="long_description">{!! $product->long_description !!}</textarea>
                                        @if ($errors->has('long_description'))
                                            <p class="text-danger">{{ $errors->first('long_description') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Loại sản phẩm</label>
                                        <select name="product_type" id="" class="form-control">
                                            <option value="">- - Chọn - -</option>
                                            <option {{ $product->product_type == 'new_product' ? 'selected' : '' }}
                                                value="new_product">Sản phẩm mới</option>
                                            <option {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
                                                value="featured_product">Sản phẩm nổi bật</option>
                                            <option {{ $product->product_type == 'top_product' ? 'selected' : '' }}
                                                value="top_product">Sản phẩm phổ biến</option>
                                            <option {{ $product->product_type == 'best_product' ? 'selected' : '' }}
                                                value="best_product">Sản phẩm tốt nhất</option>
                                        </select>
                                        @if ($errors->has('is_top'))
                                            <p class="text-danger">{{ $errors->first('is_top') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Tiêu đề dành cho SEO</label>
                                        <input type="text" class="form-control" name="seo_title"
                                            placeholder="Ví dụ: Sản phẩm hot nhất..."
                                            value="{{ old('seo_title', $product->seo_title) }}">
                                        @if ($errors->has('seo_title'))
                                            <p class="text-danger">{{ $errors->first('seo_title') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Mô tả dành cho SEO</label>
                                        <textarea class="form-control" name="seo_description">{!! $product->seo_description !!}</textarea>
                                        @if ($errors->has('seo_description'))
                                            <p class="text-danger">{{ $errors->first('seo_description') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="mb-2 fw-bold">Trạng thái</label>
                                        <select name="status" id="" class="form-control">
                                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Hiển
                                                thị
                                            </option>
                                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Không
                                                hiển
                                                thị</option>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('change', ".main-category", function(e) {
                let id = $(this).val()
                $.ajax({
                    url: "{{ route('vendor.products.get-subcategories') }}",
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

            $("body").on('change', ".sub-category", function(e) {
                let id = $(this).val()
                $.ajax({
                    url: "{{ route('vendor.products.get-childcategories') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {

                        $('.child-category').html('<option value="">- - Chọn - -</option>')

                        $.each(data, function(i, item) {
                            $(".child-category").append(
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
