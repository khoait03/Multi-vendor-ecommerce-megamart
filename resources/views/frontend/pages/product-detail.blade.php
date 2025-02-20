@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | {{ $product->name }}
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ $product->name }}</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Sản Phẩm</a></li>
                            <li><a href="#">{{ $product->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-lg-5" style="z-index: 10">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}"
                                                alt="product"></li>

                                        @foreach ($product->productImageGalleries as $image)
                                            <li><img class="zoom ing-fluid w-100" src="{{ asset($image->image) }}"
                                                    alt="product"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <p class="title" href="#">{{ $product->name }}</p>
                            <p class="brand_model mt-2"><small><strong>Mã Sản Phẩm :</strong></small>
                                <small>{{ $product->sku }}</small>
                            </p>
                            <p class="brand_model"><small><strong>Thương Hiệu :</strong></small>
                                <small>{{ $product->brand->name }}</small>
                            </p>
                            <p class="wsus__stock_area">

                                @if ($product->quantity > 0)
                                    <span class="text-success fw-bold">Còn hàng</span>
                                @else
                                    <span class="text-danger fw-bold">Hết hàng</span>
                                @endif

                                ({{ $product->quantity }} sản phẩm)
                            </p>

                            @if (checkDiscount($product))
                                <h4>{{ formatMoney($product->offer_price) }} <del>{{ formatMoney($product->price) }}
                                    </del></h4>
                            @else
                                <h4>{{ formatMoney($product->price) }} </h4>
                            @endif

                            <p class="review">
                                @php
                                    $avgRating = round($product->reviews->avg('rating'));
                                @endphp

                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $avgRating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor

                                <span>({{ count($product->reviews) }} đánh giá)</span>
                            </p>

                            <p class="description"><strong>Mô tả ngắn:</strong> {{ $product->short_description }}</p>

                            @if (checkDiscount($product))
                                <div class="wsus_pro_hot_deals">
                                    <h5>Giảm giá kết thúc sau : </h5>
                                    <div class="simply-countdown simply-countdown-example"></div>
                                </div>
                            @endif

                            <form class="shopping-cart-form" action="">

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="d-flex gap-3 mt-3 align-items-center">
                                    {{-- <div class="wsus__quentity"> --}}
                                    <h5><strong>Số lượng mua :</strong></h5>
                                    {{-- <form class="select_number"> --}}
                                    <input class="form-control w-25" name="quantity" type="number" min="1"
                                        max="{{ $product->quantity == 0 ? 1 : $product->quantity }}" value="1" />
                                    {{-- </form> --}}
                                    {{-- </div> --}}
                                </div>
                                <div class="wsus__selectbox">
                                    <div class="row">

                                        @foreach ($product->variants as $variant)
                                            @if ($variant->status !== 0)
                                                <div class="col-xl-6 col-sm-6">
                                                    <h5 class="mb-2"><strong>{{ $variant->name }}</strong>:</h5>
                                                    <select class="form-select" name="variants_items[]">

                                                        @foreach ($variant->productVariantItems as $item)
                                                            @if ($item->status !== 0)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                    {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ' )' : '' }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                <ul class="wsus__button_area mt-md-0 mt-5">
                                    <li><button type="submit" class="add_cart" href="#">Thêm vào giỏ hàng</button>
                                    </li>
                                    {{-- <li><a class="buy_now" href="#">Mua ngay</a></li> --}}
                                    <li><a href="#" class="wishlist-btn btn btn btn-outline-danger rounded-circle"
                                            data-id="{{ $product->id }}"><i class="far fa-heart"></i></a></li>
                                    @auth
                                        <li>
                                            <div class="btn btn-outline-success rounded mt-md-0 mt-3" style="margin-left: 10px"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Nhắn tin với người bán
                                            </div>
                                        </li>
                                    @endauth
                                    {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                                </ul>

                            </form>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Vận chuyển nhanh chóng</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Thanh toán dễ dàng</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Bảo mật thông tin</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                            </ul>
                            <div class="wsus__det_sidebar_banner">
                                <img src="https://www.salesforce.com/blog/wp-content/uploads/sites/2/2023/07/product-listing-page-crop-background.jpg?w=889"
                                    alt="banner" class="img-fluid w-100">
                                <div class="wsus__det_sidebar_banner_text_overlay">
                                    <div class="wsus__det_sidebar_banner_text">
                                        <p>Còn nhiều sản phẩm hấp dẫn khác</p>
                                        <h4></h4>
                                        <a href="{{ route('product.index') }}" class="common_btn">Xem ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Thông tin sản phẩm</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Thông tin gian hàng</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Đánh giá</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab239" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact239" type="button" role="tab"
                                        aria-controls="pills-contact239" aria-selected="false">Câu hỏi thường gặp</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area overflow-auto">
                                                {!! $product->long_description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset($product->vendor->banner) }}" alt="vensor"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->name }}</h4>
                                                    {{-- <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(41 đánh giá)</span>
                                                    </p> --}}
                                                    <p><span>Tên gian hàng:</span> {{ $product->vendor->name }}</p>
                                                    <p><span>Địa chỉ:</span> {{ $product->vendor->address }}</p>
                                                    <p><span>Điện thoại:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>Email:</span> {{ $product->vendor->email }}</p>
                                                    <a href="{{ route('vendor.show', $product->vendor->id) }}"
                                                        class="see_btn">Xem gian hàng</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details mt-5">
                                                    <h5 class="mb-4 fw-bold text-primary">Giới thiệu: </h5>
                                                    {!! $product->vendor->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Đánh giá sản phẩm <span>{{ $reviewCount }}</span></h4>

                                                        @foreach ($reviews as $review)
                                                            <div class="wsus__main_comment">
                                                                <div class="wsus__comment_img">
                                                                    <img src="{{ asset($review->user->image) }}"
                                                                        alt="user" class="img-fluid w-100">
                                                                </div>
                                                                <div class="wsus__comment_text">
                                                                    <h6>{{ $review->user->name }}
                                                                        <span>{{ $review->rating }} <i
                                                                                class="fas fa-star"></i></span>
                                                                    </h6>
                                                                    <span>{{ $review->created_at }}</span>
                                                                    <p>
                                                                        {{ $review->review }}
                                                                    </p>
                                                                    <ul class="">

                                                                        @if (count($review->productReviewGalleries) > 0)
                                                                            @foreach ($review->productReviewGalleries as $item)
                                                                                <li><img src="{{ asset($item->image) }}"
                                                                                        alt="product"
                                                                                        class="img-fluid w-100 h-100 p-1">
                                                                                </li>
                                                                            @endforeach
                                                                        @endif

                                                                    </ul>
                                                                    {{-- <a href="#" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapsetwo">reply</a> --}}
                                                                    {{-- <div class="accordion accordion-flush"
                                                                        id="accordionFlushExample2">
                                                                        <div class="accordion-item">
                                                                            <div id="flush-collapsetwo"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="flush-collapsetwo"
                                                                                data-bs-parent="#accordionFlushExample">
                                                                                <div class="accordion-body">
                                                                                    <form>
                                                                                        <div
                                                                                            class="wsus__riv_edit_single text_area">
                                                                                            <i class="far fa-edit"></i>
                                                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                                                        </div>
                                                                                        <button type="submit"
                                                                                            class="common_btn">submit</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        {{-- <div id="pagination">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination">
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="#"
                                                                            aria-label="Previous">
                                                                            <i class="fas fa-chevron-left"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link page_active"
                                                                            href="#">1</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">2</a></li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">3</a></li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">4</a></li>
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="#"
                                                                            aria-label="Next">
                                                                            <i class="fas fa-chevron-right"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div> --}}

                                                        @if ($reviews->hasPages())
                                                            <div class="mt-5 d-flex justify-content-center">
                                                                {{ $reviews->links() }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    @php
                                                        $isBought = false;

                                                        if (Auth::check()) {
                                                            $orders = \App\Models\Order::where([
                                                                'user_id' => Auth::user()->id,
                                                                'order_status' => 'delivered',
                                                            ])->get();

                                                            foreach ($orders as $key => $order) {
                                                                $existProduct = $order
                                                                    ->orderProducts()
                                                                    ->where('product_id', $product->id)
                                                                    ->first();
                                                                if ($existProduct) {
                                                                    $isBought = true;
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($isBought)
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4 class="mb-3">Viết đánh giá cho sản phẩm</h4>
                                                            <form action="{{ route('user.review.create') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <span>Lựa chọn đánh giá <i class="fas fa-star"
                                                                            style="color:#ff9f00"></i>
                                                                    </span>
                                                                    <select name="rating" id=""
                                                                        class="form-control mt-2">
                                                                        <option value="">- - Chọn số sao đánh giá - -
                                                                        </option>
                                                                        <option value="1"><span><i
                                                                                    class="fas fa-cog"></i> 1</span></i>
                                                                        </option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
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
                                                                                    class="form-control"></textarea>
                                                                                @if ($errors->has('review'))
                                                                                    <p class="text-danger">
                                                                                        {{ $errors->first('review') }}</p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span>Tải lên hình ảnh cho đánh giá</span>
                                                                <div class="img_upload mt-2">
                                                                    <div class="gallery">
                                                                        <input type="file" name="image[]"
                                                                            class="form-control" multiple>
                                                                        @if ($errors->has('image'))
                                                                            <p class="text-danger">
                                                                                {{ $errors->first('image') }}</p>
                                                                        @endif
                                                                        @if ($errors->has('image.*'))
                                                                            <p class="text-danger">
                                                                                {{ $errors->first('image.*') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <input type="hidden" name="vendor_id"
                                                                    value="{{ $product->vendor_id }}">
                                                                <button class="common_btn" type="submit">Gửi đánh
                                                                    giá</button>
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact239" role="tabpanel"
                                    aria-labelledby="pills-contact-tab239">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="wsus__contact_question">
                                                <h5>Câu hỏi thường gặp</h5>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                Thời gian giao hàng dự kiến là bao lâu?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Thời gian giao hàng dự kiến từ 3-5 ngày làm việc đối với
                                                                    các đơn hàng trong nước và từ 7-10 ngày làm việc đối với
                                                                    các đơn hàng quốc tế.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                Chi phí vận chuyển là bao nhiêu?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Thông thường chi phí vận chuyển trong nước là 30,000 VND.
                                                                    Miễn phí vận chuyển cho các đơn hàng trên 500,000 VND.
                                                                    Tuy nhiên chi phí này có thể thay đổi, bạn có thể xem
                                                                    chi tiết trong phần "Chi phí vận chuyển" khi đặt hàng để
                                                                    chọn phương thức vận chuyển tối ưu nhất.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                aria-expanded="false" aria-controls="collapseThree">
                                                                Sản phẩm này có bảo hành không? Nếu có thì thời gian bảo
                                                                hành là bao lâu?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Sản phẩm được bảo hành 12 tháng kể từ ngày mua. Trong
                                                                    thời gian bảo hành, nếu sản phẩm gặp bất kỳ vấn đề gì,
                                                                    bạn có thể liên hệ với chúng tôi để được hỗ trợ sửa chữa
                                                                    hoặc thay thế.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThreet1">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThreet1" aria-expanded="false"
                                                                aria-controls="collapseThreet1">
                                                                Hướng dẫn sử dụng sản phẩm này như thế nào?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThreet1" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThreet1"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Vui lòng tham khảo hướng dẫn sử dụng đính kèm trong hộp
                                                                    sản phẩm. Nếu bạn cần thêm thông tin, có thể xem video
                                                                    hướng dẫn trên trang sản phẩm hoặc liên hệ với chúng tôi
                                                                    để được hỗ trợ.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThreet2">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThreet2" aria-expanded="false"
                                                                aria-controls="collapseThreet2">
                                                                Làm sao để liên hệ với bộ phận hỗ trợ khách hàng?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThreet2" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThreet2"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Bạn có thể liên hệ với bộ phận hỗ trợ khách hàng qua
                                                                    email <b>megamart@gmail.com</b> hoặc gọi điện thoại đến
                                                                    số <b>1800
                                                                        1234</b> (miễn phí cước).</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="wsus__flash_sell">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>Sản phẩm tương tự</h3>
                        <a class="see_btn"
                            href="{{ route('product.index', ['category' => $product->category->slug]) }}">Xem thêm <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">

                @foreach ($relatedProducts as $relatedProduct)
                    @if ($relatedProduct->slug !== $product->slug)
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($relatedProduct) }}</span>
                                @if (checkDiscount($relatedProduct))
                                    <span class="wsus__minus">-{{ calculateDiscountPercent($relatedProduct) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('product-detail', $relatedProduct->slug) }}">
                                    <img src="{{ asset($relatedProduct->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1 p-4" />
                                    <img src="
            @if (isset($relatedProduct->productImageGalleries[0]->image)) {{ asset($relatedProduct->productImageGalleries[0]->image) }}
            @else
            {{ asset($relatedProduct->thumb_image) }} @endif
          "
                                        alt="product" class="img-fluid w-100 img_2 p-4" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#product-slider-1-{{ $relatedProduct->id }}"><i
                                                class="far fa-eye"></i></a>
                                    </li>
                                    <li><a href="#" class="wishlist-btn" data-id="{{ $relatedProduct->id }}"><i
                                                class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="">{{ $relatedProduct->category->name }}
                                    </a>
                                    <p class="wsus__pro_rating">
                                        @php
                                            $avgRating = round($relatedProduct->reviews->avg('rating'));
                                        @endphp

                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $avgRating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor

                                        <span>({{ count($relatedProduct->reviews) }} đánh giá)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $relatedProduct->slug) }}">{{ limitText($relatedProduct->name, 30) }}</a>
                                    @if (checkDiscount($relatedProduct))
                                        <p class="wsus__price mt-2">{{ formatMoney($relatedProduct->offer_price) }}
                                            <del>{{ formatMoney($relatedProduct->price) }} </del>
                                        </p>
                                    @else
                                        <p class="wsus__price mt-2">{{ formatMoney($relatedProduct->price) }} </p>
                                    @endif
                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">

                                        @foreach ($relatedProduct->variants as $variant)
                                            @if ($variant->status !== 0)
                                                <select class="form-select d-none" name="variants_items[]">
                                                    @foreach ($variant->productVariantItems as $item)
                                                        @if ($item->status !== 0)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ' )' : '' }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endforeach
                                        <input class="form-control w-25" name="quantity" type="hidden" min="1"
                                            max="100" value="1" />

                                        <button type="submit" class="add_cart border-0">Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắn tin với người bán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="message-modal">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="mb-2 fw-bold">Gian hàng</label>
                            <input type="text" disabled class="form-control mb-3"
                                value="{{ $product->vendor->name }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2 fw-bold">Tin nhắn</label>
                            <textarea name="message" class="form-control message-box" placeholder="Nhập tin nhắn của bạn" cols="30"
                                rows="10">Tôi cần tư vấn sản phẩm {{ $product->name }}. </textarea>
                            <input type="hidden" name="receiver_id" value="{{ $product->vendor->user_id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary send-button d-flex align-items-center gap-2">Gửi tin
                            nhắn</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#exzoom").removeClass('hidden'); // Hiển thị slider sau khi exzoom được khởi tạo
            }, 100); // Delay 1 giây (1000 milliseconds)
        });

        $(document).ready(function() {
            simplyCountdown(".simply-countdown-example", {
                year: {{ date('Y', strtotime($product->offer_end_date)) }},
                month: {{ date('m', strtotime($product->offer_end_date)) }},
                day: {{ date('d', strtotime($product->offer_end_date)) }},
                hours: {{ date('H', strtotime($product->offer_end_date)) }},
                minutes: {{ date('i', strtotime($product->offer_end_date)) }},
                enableUtc: false,
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $(".message-modal").on("submit", function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: "{{ route('user.send-message') }}",
                    data: formData,
                    beforeSend: function() {
                        let html = `
                        <span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span>
                        Đang gửi...
                        `
                        $(".send-button").html(html)
                        $(".send-button").prop("disabled", true)
                        $(".message-box").prop("disabled", true)
                    },
                    success: function(data) {
                        $(".message-box").val("")
                        $(".message-modal").append(`
                        <div class="alert alert-success">
                            <a href="{{ route('user.messages.index') }}" class="btn btn-success text-light">Nhấn vào
                                đây</a> để đi đến cuộc trò
                            chuyện.
                        </div>
                        `)
                        toastr.success(data.message)
                    },
                    error: function(data) {
                        toastr.error(data.responseJSON.message)
                        $(".send-button").prop("disabled", false)
                        $(".message-box").prop("disabled", false)
                    },
                    complete: function(data) {
                        $(".send-button").html("Gửi tin nhắn")
                        $(".send-button").prop("disabled", false)
                        $(".message-box").prop("disabled", false)
                    }
                })
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('.message-box');
            const fixedText = 'Tôi cần tư vấn sản phẩm {{ $product->name }}. ';

            // Khóa đoạn văn bản mặc định và thêm chức năng kiểm soát
            textarea.value = fixedText;

            textarea.addEventListener('input', function(e) {
                if (!textarea.value.startsWith(fixedText)) {
                    textarea.value = fixedText; // Reset nếu người dùng thay đổi đoạn văn bản cố định
                }
            });

            textarea.addEventListener('keydown', function(e) {
                const cursorPos = textarea.selectionStart;
                // Ngăn người dùng xóa phần văn bản cố định
                if (cursorPos < fixedText.length && (e.key === 'Backspace' || e.key === 'Delete')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
