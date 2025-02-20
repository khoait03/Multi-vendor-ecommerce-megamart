@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'subCategories' => function ($query) {
                $query->where('status', 1)->with([
                    'childCategories' => function ($q) {
                        $q->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();

@endphp


<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">

                        @foreach ($categories as $category)
                            {{-- <li><a href="{{ $category->slug }}"><i class="{{ $category->icon }}"></i>
                                    {{ $category->name }}</a></li> --}}

                            <li>
                                <a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('product.index', ['category' => $category->slug]) }}">
                                    <i class="{{ $category->icon }}"></i> {{ $category->name }}
                                </a>

                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">

                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a
                                                    href="{{ route('product.index', ['sub_category' => $subCategory->slug]) }}">{{ $subCategory->name }}
                                                    <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>

                                                @if (count($subCategory->childCategories) > 0)
                                                    <ul class="wsus__sub_category">

                                                        @foreach ($subCategory->childCategories as $childCategory)
                                                            <li>
                                                                <a
                                                                    href="{{ route('product.index', ['child_category' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                @endif


                                            </li>
                                        @endforeach

                                    </ul>
                                @endif

                            </li>
                        @endforeach

                        <li><a href="#"><i class="fal fa-gem"></i> Xem Tất Cả Danh Mục</a></li>
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="{{ setActive(['home']) }}" href="{{ route('home') }}">Trang Chủ</a></li>
                        {{-- <li><a href="product_grid_view.html">shop <i class="fas fa-caret-down"></i></a>
                            <div class="wsus__mega_menu">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>men</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>category</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#"> Healthy & Beauty</a></li>
                                                <li><a href="#">Gift Ideas</a></li>
                                                <li><a href="#">Toy & Games</a></li>
                                                <li><a href="#">Cooking</a></li>
                                                <li><a href="#">Smart Phones</a></li>
                                                <li><a href="#">Cameras & Photo</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">View All Categories</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        <li><a class="{{ setActive(['product.index']) }}" href="{{ route('product.index') }}">Sản
                                Phẩm</a></li>
                        <li><a class="{{ setActive(['vendors.index', 'vendor.show']) }}"
                                href="{{ route('vendors.index') }}">Gian
                                Hàng</a></li>
                        <li><a class="{{ setActive(['blog-list', 'blog-detail']) }}"
                                href="{{ route('blog-list') }}">Bài Viết</a>
                        </li>
                        <li><a class="{{ setActive(['about']) }}" href="{{ route('about') }}">Giới Thiệu</a></li>
                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">Liên Hệ</a></li>
                        {{-- <li class="wsus__relative_li"><a href="#">pages <i class="fas fa-caret-down"></i></a>
                            <ul class="wsus__menu_droapdown">
                                <li><a href="404.html">404</a></li>
                                <li><a href="faqs.html">faq</a></li>
                                <li><a href="invoice.html">invoice</a></li>
                                <li><a href="about_us.html">about</a></li>
                                <li><a href="product_grid_view.html">product</a></li>
                                <li><a href="check_out.html">check out</a></li>
                                <li><a href="team.html">team</a></li>
                                <li><a href="change_password.html">change password</a></li>
                                <li><a href="custom_page.html">custom page</a></li>
                                <li><a href="forget_password.html">forget password</a></li>
                                <li><a href="privacy_policy.html">privacy policy</a></li>
                                <li><a href="product_category.html">product category</a></li>
                                <li><a href="brands.html">brands</a></li>
                            </ul>
                        </li> --}}
                        <li><a class="{{ setActive(['order-tracking.index']) }}"
                                href="{{ route('order-tracking.index') }}">Trạng Thái Đơn Hàng</a></li>
                        {{-- <li><a href="daily_deals.html">daily deals</a></li> --}}
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        @auth
                            <li><a
                                    href="{{ Auth::user()->role === 'user' || Auth::user()->role === 'vendor' ? route('user.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('home')) }}">Tài
                                    khoản</a></li>
                            @if (Auth::user()->role === 'vendor')
                                <li><a
                                        href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : route('home') }}">Gian
                                        hàng</a></li>
                            @endif
                            <li>Xin chào, {{ Auth::user()->name }}!</li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập / Đăng ký</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!--============================
  MAIN MENU END
==============================-->


<!--============================
  MOBILE MENU START
==============================-->
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        <li><a href="{{ route('wishlist.index') }}"><i class="fal fa-heart"></i><span
                    id="wishlist-count">{{ Auth::check() ? \App\Models\Wishlist::where('user_id', Auth::user()->id)->count() : 0 }}</span></a>
        </li>

        {{-- <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li> --}}

        @auth
            <li><a
                    href="{{ Auth::user()->role === 'user' || Auth::user()->role === 'vendor' ? route('user.dashboard') : (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('home')) }}"><i
                        class="fas fa-user"></i></a></li>
            @if (Auth::user()->role === 'vendor')
                <li><a href="{{ Auth::user()->role === 'vendor' ? route('vendor.dashboard') : route('home') }}"><i
                            class="fas fa-warehouse"></i></a></li>
            @endif
        @else
            <li><a href="{{ route('login') }}">Đăng nhập / Đăng ký</a></li>
        @endauth
    </ul>
    <form action="{{ route('product.index') }}">
        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Danh Mục</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">Menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">

                        @foreach ($categories as $category)
                            <li><a href="{{ $category->slug }}"
                                    class="{{ count($category->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $category->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $category->id }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }}</a>

                                @if (count($category->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $category->id }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>

                                                @foreach ($category->subCategories as $subCategory)
                                                    <li>
                                                        <a
                                                            href="{{ $subCategory->slug }}">{{ $subCategory->name }}</a>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                    </div>
                                @endif


                            </li>
                        @endforeach


                        <li><a href="#"><i class="fal fa-gem"></i> Xem Danh Sách Danh Mục</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a class="{{ setActive(['home']) }}" href="{{ route('home') }}">Trang Chủ</a></li>
                        <li><a class="{{ setActive(['product.index']) }}" href="{{ route('product.index') }}">Sản
                                Phẩm</a></li>
                        <li><a class="{{ setActive(['vendors.index', 'vendor.show']) }}"
                                href="{{ route('vendors.index') }}">Gian
                                Hàng</a></li>
                        <li><a class="{{ setActive(['blog-list', 'blog-detail']) }}"
                                href="{{ route('blog-list') }}">Bài Viết</a>
                        </li>
                        <li><a class="{{ setActive(['about']) }}" href="{{ route('about') }}">Giới Thiệu</a></li>
                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">Liên Hệ</a></li>
                        <li><a class="{{ setActive(['order-tracking.index']) }}"
                                href="{{ route('order-tracking.index') }}">Trạng Thái Đơn Hàng</a></li>
                        {{-- <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">shop</a>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">men's</a></li>
                                        <li><a href="#">wemen's</a></li>
                                        <li><a href="#">kid's</a></li>
                                        <li><a href="#">others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="vendor.html">vendor</a></li>
                        <li><a href="blog.html">blog</a></li>
                        <li><a href="daily_deals.html">campain</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                aria-controls="flush-collapseThree101">pages</a>
                            <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="faqs.html">faq</a></li>
                                        <li><a href="invoice.html">invoice</a></li>
                                        <li><a href="about_us.html">about</a></li>
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="product_grid_view.html">product grid view</a></li>
                                        <li><a href="product_grid_view.html">product list view</a></li>
                                        <li><a href="team_details.html">team details</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="track_order.html">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
  MOBILE MENU END
==============================-->
