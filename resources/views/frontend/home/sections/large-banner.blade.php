<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            @if ($homePageBannerFour->banner_one->status == 1)
                <div class="cl-xl-12">
                    <div class="wsus__large_banner_content"
                        style="background: url({{ asset($homePageBannerFour->banner_one->banner_image) }});">
                        <div class="wsus__large_banner_content_overlay">
                            <div class="row">
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__large_banner_text">
                                        <h3>Khuyến mãi cuối tuần</h3>
                                        <p>Cuối tuần bung lụa, mua sắm thả ga - Ưu đãi cực sốc, giảm giá ngập tràn!</p>
                                        <a class="shop_btn" href="{{ $homePageBannerFour->banner_one->banner_url }}">Xem
                                            thêm</a>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-6 col-12 col-md-6">
                              <div class="wsus__large_banner_text wsus__large_banner_text_right">
                                  <h3>headphones</h3>
                                  <h5>up to 20% off</h5>
                                  <p>Spring's collection has discounted now!</p>
                                  <a class="shop_btn" href="#">shop now</a>
                              </div>
                          </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
