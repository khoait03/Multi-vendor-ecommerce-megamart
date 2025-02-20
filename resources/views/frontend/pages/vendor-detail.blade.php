@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian Hàng
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Gian Hàng {{ $vendor->name }}</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Gian Hàng</a></li>
                            <li><a href="#">{{ $vendor->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_page" class="wsus__vendor_details_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 pb-5 border-bottom">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset($vendor->banner) }}" alt="banner" class="img-fluid w-100 rounded">
                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">
                            <h4 class="mb-3" style="color: #08c">Tên gian hàng: {{ $vendor->name }}</h4>
                            <p class="mb-3"><i class="far fa-phone-alt"></i> {{ $vendor->phone }}</p>
                            <p class="mb-3"><i class="far fa-envelope"></i> {{ $vendor->email }}</p>
                            <p class="mb-3"><i class="fal fa-map-marker-alt"></i> {{ $vendor->address }}
                            </p>
                            <h5 class="mb-3">Giới thiệu:</h5>
                            <p>{!! $vendor->description !!}</p>
                            <ul class="d-flex mt-3 gap-3">
                                <li class="border rounded" style="padding: 10px 20px; background-color: #fff;"><a
                                        href="{{ $vendor->fb_link }}"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="border rounded" style="padding: 10px 20px; background-color: #fff;"><a
                                        href="{{ $vendor->tw_link }}"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="border rounded" style="padding: 10px 20px; background-color: #fff;"><a
                                        href="{{ $vendor->insta_link }}"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    {{-- <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset($vendor->banner) }}" alt="banner" class="img-fluid w-100 h-50">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>vendor 2</h4>
                                <p class="wsus__vendor_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </p>
                                <a href="callto:+962555544411"><i class="far fa-phone-alt"></i> +962555544411</a>
                                <a href="mailto:example@gmail.com"><i class="far fa-envelope"></i> example@gmail.com</a>
                                <p class="wsus__vendor_location"><i class="fal fa-map-marker-alt"></i> Steven Street, El
                                    Carjon California, United States (US) </p>
                                <p class="wsus__open_store"><i class="fab fa-shopify"></i> store open</p>
                                <ul class="d-flex">
                                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                                <a class="common_btn" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="fas fa-star"></i>add review</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-xl-12 pt-5">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') ? (session()->get('product_list_style') == 'grid' ? 'active' : '') : 'active' }}"
                                            data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') ? (session()->get('product_list_style') == 'list' ? 'active' : '') : '' }}"
                                            data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>default shorting</option>
                                            <option>short by rating</option>
                                            <option>short by latest</option>
                                            <option>low to high </option>
                                            <option>high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ session()->has('product_list_style') ? (session()->get('product_list_style') == 'grid' ? 'show active' : '') : 'show active' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">

                                    @foreach ($products as $product)
                                        <div class="col-xl-3  col-sm-6">
                                            <div class="wsus__product_item">
                                                <span class="wsus__new">{{ productType($product) }}</span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="wsus__minus">-{{ calculateDiscountPercent($product) }}%</span>
                                                @endif
                                                <a class="wsus__pro_link"
                                                    href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1 p-4" />
                                                    <img src="
                                @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                @else
                                {{ asset($product->thumb_image) }} @endif
                              "
                                                        alt="product" class="img-fluid w-100 img_2 p-4" />
                                                </a>
                                                <ul class="wsus__single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#product-list-{{ $product->id }}"><i
                                                                class="far fa-eye"></i></a></li>
                                                    <li><a href="#" class="wishlist-btn"
                                                            data-id="{{ $product->id }}"><i
                                                                class="far fa-heart"></i></a>
                                                    </li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                        href="">{{ $product->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
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
                                                    <a class="wsus__pro_name"
                                                        href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 30) }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price mt-2">
                                                            {{ formatMoney($product->offer_price) }}
                                                            <del>{{ formatMoney($product->price) }} </del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price mt-2">{{ formatMoney($product->price) }}
                                                        </p>
                                                    @endif

                                                    <form class="shopping-cart-form">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">

                                                        @foreach ($product->variants as $variant)
                                                            @if ($variant->status !== 0)
                                                                <select class="form-select d-none"
                                                                    name="variants_items[]">
                                                                    @foreach ($variant->productVariantItems as $item)
                                                                        @if ($item->status !== 0)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                                {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ')' : '' }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                        <input class="form-control w-25" name="quantity" type="hidden"
                                                            min="1" max="100" value="1" />

                                                        <button type="submit" class="add_cart border-0">Thêm vào giỏ
                                                            hàng</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- <div class="col-xl-4  col-sm-6">
                                    <div class="wsus__product_item">
                                        <span class="wsus__new">New</span>
                                        <span class="wsus__minus">-20%</span>
                                        <a class="wsus__pro_link" href="product_details.html">
                                            <img src="images/pro4.jpg" alt="product"
                                                class="img-fluid w-100 img_1" />
                                            <img src="images/pro4_4.jpg" alt="product"
                                                class="img-fluid w-100 img_2" />
                                        </a>
                                        <ul class="wsus__single_pro_icon">
                                            <li><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a>
                                        </ul>
                                        <div class="wsus__product_details">
                                            <a class="wsus__category" href="#">fashion </a>
                                            <p class="wsus__pro_rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>(17 review)</span>
                                            </p>
                                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                                            <p class="wsus__price">$159 <del>$200</del></p>
                                            <a class="add_cart" href="#">add to cart</a>
                                        </div>
                                    </div>
                                </div> --}}


                                </div>
                            </div>
                            <div class="tab-pane fade {{ session()->has('product_list_style') ? (session()->get('product_list_style') == 'list' ? 'show active' : '') : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">

                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <span class="wsus__new">{{ productType($product) }}</span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="wsus__minus">-{{ calculateDiscountPercent($product) }}%</span>
                                                @endif
                                                <a class="wsus__pro_link"
                                                    href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1 p-4" />
                                                    <img src="
                                              @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                              @else
                                              {{ asset($product->thumb_image) }} @endif
                                            "
                                                        alt="product" class="img-fluid w-100 img_2 p-4" />
                                                </a>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                        href="#">{{ $product->category->name }} </a>
                                                    <p class="wsus__pro_rating">
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
                                                    <a class="wsus__pro_name"
                                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price mt-2">
                                                            {{ formatMoney($product->offer_price) }}
                                                            <del>{{ formatMoney($product->price) }} </del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price mt-2">{{ formatMoney($product->price) }}
                                                        </p>
                                                    @endif
                                                    <p class="list_description">{{ $product->short_description }}</p>
                                                    <ul class="wsus__single_pro_icon">
                                                        {{-- <li><a class="add_cart" href="#">add to cart</a></li> --}}
                                                        <form class="shopping-cart-form">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">

                                                            @foreach ($product->variants as $variant)
                                                                @if ($variant->status !== 0)
                                                                    <select class="form-select d-none"
                                                                        name="variants_items[]">
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
                                                            <input class="form-control w-25" name="quantity"
                                                                type="hidden" min="1" max="100"
                                                                value="1" />

                                                            <button type="submit" class="add_cart border-0 rounded">Thêm
                                                                vào giỏ
                                                                hàng</button>
                                                        </form>
                                                        <li style="margin-left: 10px"><a href="#"
                                                                class="wishlist-btn" data-id="{{ $product->id }}"><i
                                                                    class="far fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="far fa-random"></i></a>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @if ($products->hasPages())
                            <div class="mt-5 d-flex justify-content-center">{{ $products->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                    @if (count($products) == 0)
                        <div class="text-center mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Không có sản phẩm</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    @foreach ($products as $product)
        <section class="product_popup_modal">
            <div class="modal fade" id="product-list-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        @if ($product->video_link)
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true"
                                                data-vbtype="video" href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif
                                        <div class="row modal_slider">
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @if (count($product->productImageGalleries) > 0)
                                                @foreach ($product->productImageGalleries as $image)
                                                    <div class="col-xl-12">
                                                        <div class="modal_slider_img">
                                                            <img src="{{ asset($image->image) }}" alt="product"
                                                                class="img-fluid w-100">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <p class="title">{{ $product->name }}</p>
                                        <p class="wsus__stock_area">
                                            @if ($product->quantity > 0)
                                                <span class="text-success fw-bold">Còn hàng</span>
                                            @else
                                                <span class="text-danger fw-bold">Hết hàng</span>
                                            @endif
                                            ({{ $product->quantity }} sản phẩm)
                                        </p>
                                        @if (checkDiscount($product))
                                            <h4>{{ formatMoney($product->offer_price) }}
                                                <del>{{ formatMoney($product->price) }}
                                                </del>
                                            </h4>
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
                                        <p class="description"><strong>Mô tả ngắn:</strong>
                                            {{ $product->short_description }}</p>

                                        @if (checkDiscount($product))
                                            <div class="wsus_pro_hot_deals">
                                                <h5>Giảm giá kết thúc sau : </h5>
                                                <div class="simply-countdown simply-countdown-mini"></div>
                                            </div>
                                        @endif
                                        <form class="shopping-cart-form" action="">

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <div class="d-flex gap-3 mt-3 align-items-center">
                                                {{-- <div class="wsus__quentity"> --}}
                                                <h5><strong>Số lượng mua :</strong></h5>
                                                {{-- <form class="select_number"> --}}
                                                <input class="form-control w-25" name="quantity" type="number"
                                                    min="1" max="100" value="1" />
                                                {{-- </form> --}}
                                                {{-- </div> --}}
                                            </div>
                                            <div class="wsus__selectbox">
                                                <div class="row">

                                                    @foreach ($product->variants as $variant)
                                                        @if ($variant->status !== 0)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">
                                                                    <strong>{{ $variant->name }}</strong>:
                                                                </h5>
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
                                            <ul class="wsus__button_area">
                                                <li><button type="submit" class="add_cart" href="#">Thêm
                                                        vào giỏ
                                                        hàng</button>
                                                </li>
                                                <li><a class="buy_now" href="#">Mua ngay</a></li>
                                                <li><a href="#" class="wishlist-btn"
                                                        data-id="{{ $product->id }}"><i class="fal fa-heart"></i></a>
                                                </li>
                                                <li><a href="#"><i class="far fa-random"></i></a></li>
                                            </ul>

                                        </form>
                                        <p class="brand_model"><span>Mã Sản Phẩm :</span> {{ $product->sku }}
                                        </p>
                                        <p class="brand_model"><span>Thương Hiệu :</span>
                                            {{ $product->brand->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".list-view").on("click", function() {
                let style = $(this).data("id")

                $.ajax({
                    method: "GET",
                    url: "{{ route('change-product-list-view') }}",
                    data: {
                        style: style
                    },
                    success: function(data) {

                    }
                })
            })
        })

        @php
            if (request()->has('price_range') && request()->price_range != '') {
                $price = explode(';', request()->price_range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = 100000000;
            }

        @endphp

        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 100000000,
                step: 500000,
                values: [{{ $from }}, {{ $to }}],
                range: true,
                einheit: "đ",
            });
        });
    </script>
@endpush
