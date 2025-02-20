<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>Sản phẩm theo loại</h3>
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active" data-filter="*">Tất cả</button>
                            <button data-filter=".new_product">Sản phẩm mới</button>
                            <button data-filter=".featured_product">Sản phẩm nổi bật</button>
                            <button data-filter=".top_product">Sản phẩm phổ biến</button>
                            <button data-filter=".best_product">Sản phẩm tốt nhất</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProducts as $key => $products)
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :key="$key" />
                    @endforeach
                @endforeach

            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    @if ($homePageBannerThree->banner_one->status == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="wsus__single_banner_content banner_1">
                                <div class="wsus__single_banner_img">
                                    <img src="{{ asset($homePageBannerThree->banner_one->banner_image) }}"
                                        alt="banner" class="img-fluid w-100">
                                </div>
                                <div class="wsus__single_banner_text">
                                    {{-- <h6>sell on <span>35% off</span></h6>
                              <h3>smart watch</h3> --}}
                                    <a class="shop_btn" href="{{ $homePageBannerThree->banner_one->banner_url }}">Xem
                                        ngay</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            @if ($homePageBannerThree->banner_two->status == 1)
                                <div class="col-12">
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{ asset($homePageBannerThree->banner_two->banner_image) }}"
                                                alt="banner" class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            {{-- <h6>New Collection</h6>
                                      <h3>kid's fashion</h3> --}}
                                            <a class="shop_btn"
                                                href="{{ $homePageBannerThree->banner_two->banner_url }}">Xem ngay</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($homePageBannerThree->banner_three->status == 1)
                                <div class="col-12 mt-lg-4">
                                    <div class="wsus__single_banner_content">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{ asset($homePageBannerThree->banner_three->banner_image) }}"
                                                alt="banner" class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            {{-- <h6>sell on <span>42% off</span></h6>
                                      <h3>winter collection</h3> --}}
                                            <a class="shop_btn"
                                                href="{{ $homePageBannerThree->banner_three->banner_url }}">Xem ngay</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</section>
