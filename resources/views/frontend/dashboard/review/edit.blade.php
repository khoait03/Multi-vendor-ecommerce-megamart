@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Đánh giá
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('user.review.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-plus"></i> Chỉnh sửa đánh giá cho sản phẩm {{ $review->product->name }}</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">


                        <form action="{{ route('user.reviews.update', $review->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <span>Số sao đánh giá <i class="fas fa-star" style="color:#ff9f00"></i>
                                </span>
                                <select name="rating" id="" class="form-control mt-2">
                                    <option value="">- - Chọn số sao đánh giá - -
                                    </option>
                                    <option {{ $review->rating == 1 ? 'selected' : '' }} value="1"><span><i
                                                class="fas fa-cog"></i> 1</span></i>
                                    </option>
                                    <option {{ $review->rating == 2 ? 'selected' : '' }} value="2">2</option>
                                    <option {{ $review->rating == 3 ? 'selected' : '' }} value="3">3</option>
                                    <option {{ $review->rating == 4 ? 'selected' : '' }} value="4">4</option>
                                    <option {{ $review->rating == 5 ? 'selected' : '' }} value="5">5</option>
                                </select>
                                @if ($errors->has('rating'))
                                    <p class="text-danger">
                                        {{ $errors->first('rating') }}
                                    </p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="col-xl-12">
                                        <span>Đánh giá của bạn
                                        </span>
                                        <div class="mb-3 mt-2">
                                            <textarea name="review" cols="3" rows="3" placeholder="Viết cảm nhận của bạn về sản phẩm..."
                                                class="form-control">{{ $review->review }}</textarea>
                                            @if ($errors->has('review'))
                                                <p class="text-danger">
                                                    {{ $errors->first('review') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span>Tải lên hình ảnh cho đánh giá</span>

                            @if (count($review->productReviewGalleries) > 0)
                                <div class="d-flex align-items-center gap-3 mt-2 mb-3">
                                    @foreach ($review->productReviewGalleries as $item)
                                        <div class="p-3 border rounded">
                                            <img src="{{ asset($item->image) }}" alt="product" class=""
                                                width="150px">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="image[]" class="form-control" multiple>
                            @if ($errors->has('image'))
                                <p class="text-danger">
                                    {{ $errors->first('image') }}</p>
                            @endif
                            @if ($errors->has('image.*'))
                                <p class="text-danger">
                                    {{ $errors->first('image.*') }}</p>
                            @endif
                            <button class="common_btn mt-5" type="submit">Cập nhật đánh
                                giá</button>
                        </form>
                    </div>
                    {{-- <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="vendor_id" value="{{ $product->vendor_id }}"> --}}



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
