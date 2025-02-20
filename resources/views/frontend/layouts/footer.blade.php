@php
    $footerInfo = Cache::rememberForever('footer_info', function () {
        return \App\Models\FooterInfo::first();
    });
    $footerContent1 = Cache::rememberForever('footer_content_1', function () {
        return \App\Models\FooterGridTwo::where(['column' => 1, 'status' => 1])->get();
    });
    $footerContent2 = Cache::rememberForever('footer_content_2', function () {
        return \App\Models\FooterGridTwo::where(['column' => 2, 'status' => 1])->get();
    });
@endphp


<!--============================
    FOOTER PART START
==============================-->
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="#">
                        <img src="{{ asset($footerInfo->logo) }}" alt="logo">
                    </a>
                    <a class="action" href="callto:+8896254857456"><i class="fas fa-phone-alt"></i>
                        {{ $footerInfo->phone }}</a>
                    <a class="action" href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                        {{ $footerInfo->email }}</a>
                    <p><i class="fal fa-map-marker-alt"></i>{{ $footerInfo->address }}</p>
                    {{-- <ul class="wsus__footer_social">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>Hỗ trợ - Dịch vụ</h5>
                    <ul class="wsus__footer_menu">

                        @foreach ($footerContent1 as $content)
                            <li><a href="{{ $content->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $content->name }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>Thông Tin</h5>
                    <ul class="wsus__footer_menu">

                        @foreach ($footerContent2 as $content)
                            <li><a href="{{ $content->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $content->name }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Đăng ký nhận tin tức mới nhất</h3>
                    <p>Nhận tất cả thông tin về khuyến mãi, giảm giá, thành viên,... của chúng tôi</p>
                    <form action="{{ route('new-letter-request') }}" method="POST" id="new-letter">
                        @csrf

                        <input type="text" name="email" placeholder="Nhập email của bạn...">
                        <button type="submit" class="common_btn subscriber-btn">Đăng ký</button>
                    </form>
                    {{-- <div class="footer_payment">
                      <p>We're using safe payment for :</p>
                      <img src="images/credit2.png" alt="card" class="img-fluid">
                  </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        {{-- <div class="container">
          <div class="row">
              <div class="col-xl-12">
                  <div class="wsus__copyright d-flex justify-content-center">
                      <p>Made by HuyBach</p>
                  </div>
              </div>
          </div>
      </div> --}}
    </div>
</footer>
<!--============================
  FOOTER PART END
==============================-->
