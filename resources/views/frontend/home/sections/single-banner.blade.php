<section id="wsus__single_banner" class="wsus__single_banner_2">
    <div class="container">
        <div class="row">
            @if ($homePageBannerTwo->banner_one->status == 1)
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <a href="{{ $homePageBannerTwo->banner_one->banner_url }}">
                                <img src="{{ asset($homePageBannerTwo->banner_one->banner_image) }}" alt="banner"
                                    class="img-fluid w-100">
                            </a>
                        </div>
                        {{-- <div class="wsus__single_banner_text">
                      <h6>sell on <span>35% off</span></h6>
                      <h3>smart watch</h3>
                      <a class="shop_btn" href="{{ $homePageBannerTwo->banner_one->banner_url }}">shop now</a>
                  </div> --}}
                    </div>
                </div>
            @endif
            @if ($homePageBannerTwo->banner_two->status)
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <a href="{{ $homePageBannerTwo->banner_two->banner_url }}"><img
                                    src="{{ asset($homePageBannerTwo->banner_two->banner_image) }}" alt="banner"
                                    class="img-fluid w-100"></a>
                        </div>
                        {{-- <div class="wsus__single_banner_text">
                      <h6>New Collection</h6>
                      <h3>bicycle</h3>
                      <a class="shop_btn" href="#">shop now</a>
                  </div> --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
