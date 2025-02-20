@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Sản Phẩm</a></div>
            </div>
        </div>

        <div class="section-body">
            <a
                href="{{ $product->vendor_id == Auth::user()->id ? route('admin.products.index') : ($product->is_approved == 1 ? route('admin.seller-products.index') : route('admin.seller-pending-products.index')) }}">
                < Quay lại</a>
                    <h2 class="section-title">Sản Phẩm</h2>
                    <p class="section-lead">Tuỳ chỉnh các sản phẩm có trong trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chỉnh sửa sản phẩm</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Ảnh đại diện của sản phẩm</label>
                                            <br>
                                            <img src="{{ asset($product->thumb_image) }}" width="150px" alt="">
                                            <input type="file" class="form-control mt-3" name="thumb_image">
                                            @if ($errors->has('thumb_image'))
                                                <p class="text-danger">{{ $errors->first('thumb_image') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Iphone 15" value="{{ old('name', $product->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Danh mục cấp 1</label>
                                                    <select name="category" id=""
                                                        class="form-control main-category">
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
                                                <div class="form-group">
                                                    <label>Danh mục cấp 2</label>
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
                                                <div class="form-group">
                                                    <label>Danh mục cấp 3</label>
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
                                                        <p class="text-danger">{{ $errors->first('child_category') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Thương hiệu</label>
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
                                        <div class="form-group">
                                            <label>Mã sản phẩm (SKU)</label>
                                            <input type="text" class="form-control" name="sku"
                                                placeholder="Ví dụ: ABC123" value="{{ old('sku', $product->sku) }}">
                                            @if ($errors->has('sku'))
                                                <p class="text-danger">{{ $errors->first('sku') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giá gốc của sản phẩm (VNĐ)</label>
                                            <input type="text" class="form-control" name="price"
                                                placeholder="Ví dụ: 15000000" value="{{ old('price', $product->price) }}">
                                            @if ($errors->has('price'))
                                                <p class="text-danger">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giá bán thực tế của sản phẩm (VNĐ)</label>
                                            <input type="text" class="form-control" name="offer_price"
                                                placeholder="Ví dụ: 15000000"
                                                value="{{ old('offer_price', $product->offer_price) }}">
                                            @if ($errors->has('offer_price'))
                                                <p class="text-danger">{{ $errors->first('offer_price') }}</p>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Ngày bắt đầu giảm giá (Nếu có)</label>
                                                    <input type="text" name="offer_start_date"
                                                        class="form-control datepicker"
                                                        value="{{ old('offer_start_date', $product->offer_start_date) }}">
                                                    @if ($errors->has('offer_start_date'))
                                                        <p class="text-danger">{{ $errors->first('offer_start_date') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Ngày kết thúc giảm giá (Nếu có)</label>
                                                    <input type="text" name="offer_end_date"
                                                        class="form-control datepicker"
                                                        value="{{ old('offer_end_date', $product->offer_end_date) }}">
                                                    @if ($errors->has('offer_end_date'))
                                                        <p class="text-danger">{{ $errors->first('offer_end_date') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượng sản phẩm trong kho</label>
                                            <input type="number" min="0" class="form-control" name="quantity"
                                                placeholder="Ví dụ: 1 hoặc 2 hoặc 3..."
                                                value="{{ old('quantity', $product->quantity) }}">
                                            @if ($errors->has('quantity'))
                                                <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Video giới thiệu sản phẩm (Nếu có)</label>
                                            <input type="text" class="form-control" name="video_link"
                                                placeholder="Ví dụ: https://www.youtube.com/watch?v=UYXz1j0RUWQ"
                                                value="{{ old('video_link', $product->video_link) }}">
                                            @if ($errors->has('video_link'))
                                                <p class="text-danger">{{ $errors->first('video_link') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giới thiệu tóm tắt về sản phẩm (0-200 chữ)</label>
                                            <textarea class="form-control" name="short_description">{!! $product->short_description !!}</textarea>
                                            @if ($errors->has('short_description'))
                                                <p class="text-danger">{{ $errors->first('short_description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Giới thiệu chi tiết về sản phẩm</label>
                                            <textarea class="editor" name="long_description">{!! $product->long_description !!}</textarea>
                                            @if ($errors->has('long_description'))
                                                <p class="text-danger">{{ $errors->first('long_description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Loại sản phẩm</label>
                                            <select name="product_type" id="" class="form-control">
                                                <option value="">- - Chọn - -</option>
                                                <option {{ $product->product_type == 'new_product' ? 'selected' : '' }}
                                                    value="new_product">Sản phẩm mới</option>
                                                <option
                                                    {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
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
                                        <div class="form-group">
                                            <label>Tiêu đề dành cho SEO</label>
                                            <input type="text" class="form-control" name="seo_title"
                                                placeholder="Ví dụ: Sản phẩm hot nhất..."
                                                value="{{ old('seo_title', $product->seo_title) }}">
                                            @if ($errors->has('seo_title'))
                                                <p class="text-danger">{{ $errors->first('seo_title') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả dành cho SEO</label>
                                            <textarea class="form-control" name="seo_description">{!! $product->seo_description !!}</textarea>
                                            @if ($errors->has('seo_description'))
                                                <p class="text-danger">{{ $errors->first('seo_description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
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
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('change', ".main-category", function(e) {
                $('.child-category').html('<option value="">- - Chọn - -</option>')
                let id = $(this).val()
                $.ajax({
                    url: "{{ route('admin.products.get-subcategories') }}",
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
                    url: "{{ route('admin.products.get-childcategories') }}",
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
