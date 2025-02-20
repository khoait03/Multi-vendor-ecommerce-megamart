@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Sản phẩm
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Sản phẩm</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Sản Phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                {{-- <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer">
                        <img src="https://t4.ftcdn.net/jpg/04/26/10/43/360_F_426104311_2Ptfv8lBJ5OmtDjoMFVUiGq1mY236q0z.jpg"
                            alt="banner" class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text">
                            <div class="wsus__pro_page_bammer_text_center">
                                <p>up to <span>70% off</span></p>
                                <h5>wemen's jeans Collection</h5>
                                <h3>fashion for wemen's</h3>
                                <a href="#" class="add_cart">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>filter</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary mb-3">Làm Mới</a>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Tất Cả Danh Mục
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>

                                            @foreach ($categories as $category)
                                                <li><a href="{{ route('product.index', array_merge(request()->query(), ['category' => $category->slug])) }}"
                                                        class="{{ request()->has('category') ? (request()->category == $category->slug ? 'text-primary fw-bold' : '') : '' }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Giá Sản Phẩm
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="{{ url()->current() }}">
                                            @foreach (request()->query() as $key => $value)
                                                @if ($key != 'price_range')
                                                    <input type="hidden" id="" class=""
                                                        name="{{ $key }}" value="{{ $value }}" />
                                                @endif
                                            @endforeach
                                            <div class="price_ranger">
                                                <input type="hidden" name="price_range" id="slider_range"
                                                    class="flat-slider" />
                                                <button type="submit" class="common_btn">Lọc</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Thương Hiệu
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <ul>
                                            @foreach ($brands as $brand)
                                                <li>
                                                    <a href="{{ route('product.index', array_merge(request()->query(), ['brand' => $brand->slug])) }}"
                                                        class="{{ request()->has('brand') ? (request()->brand == $brand->slug ? 'text-primary fw-bold' : '') : '' }}">
                                                        {{ $brand->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault11">
                                            <label class="form-check-label" for="flexCheckDefault11">
                                                gentle park
                                            </label>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
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
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="sort" id="sortSelect">
                                        <option
                                            value="{{ route('product.index', array_merge(request()->query(), ['sort' => 'default'])) }}"
                                            {{ !request()->has('sort') ? 'selected' : '' }}>Mặc định</option>
                                        <option
                                            value="{{ route('product.index', array_merge(request()->query(), ['sort' => 'name-asc'])) }}"
                                            {{ request()->sort == 'name-asc' ? 'selected' : '' }}>Sắp xếp từ A-Z
                                        </option>
                                        <option
                                            value="{{ route('product.index', array_merge(request()->query(), ['sort' => 'name-desc'])) }}"
                                            {{ request()->sort == 'name-desc' ? 'selected' : '' }}>Sắp xếp từ Z-A
                                        </option>
                                        <option
                                            value="{{ route('product.index', array_merge(request()->query(), ['sort' => 'price-low-to-high'])) }}"
                                            {{ request()->sort == 'price-low-to-high' ? 'selected' : '' }}>Giá tăng dần
                                        </option>
                                        <option
                                            value="{{ route('product.index', array_merge(request()->query(), ['sort' => 'price-high-to-low'])) }}"
                                            {{ request()->sort == 'price-high-to-low' ? 'selected' : '' }}>Giá giảm dần
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ session()->has('product_list_style') ? (session()->get('product_list_style') == 'grid' ? 'show active' : '') : 'show active' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">

                                    @foreach ($products as $product)
                                        <x-product-card :product="$product" :column="4" />
                                    @endforeach

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

                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $product->reviews_avg_rating)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ $product->reviews_count }} đánh giá)</span>
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
                                                    <p style="width: 90%; word-wrap: break-word; margin: 15px 0">
                                                        {{ limitText($product->short_description, 165) }}
                                                    </p>
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
                                                                                    {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ')' : '' }}
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
                                                        {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
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

            $('#sortSelect').on('change', function() {
                window.location.href = this.value;
            });
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
