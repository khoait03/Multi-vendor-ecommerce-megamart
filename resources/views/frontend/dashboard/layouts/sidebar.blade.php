<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('user.dashboard') }}" class="dash_logo p-3 bg-white">
        <img src="{{ asset('logo_transparent.png') }}" width="140px" alt="logo" class="img-fluid">
        <p class="mt-2 ">Khách hàng</p>
    </a>
    <ul class="dashboard_link">
        <li><a class="mb-4 bg-dark" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i>Quay
                về Trang
                chủ</a>
        </li>
        <li><a class="{{ setActive(['user.dashboard']) }}" href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Thống Kê</a></li>
        <li><a class="{{ setActive(['user.orders.*']) }}" href="{{ route('user.orders.index') }}"><i
                    class="far fa-scroll"></i> Đơn Hàng</a></li>
        <li><a class="{{ setActive(['user.review.*']) }}" href="{{ route('user.review.index') }}"><i
                    class="far fa-star"></i> Đánh Giá</a></li>
        <li><a class="{{ setActive(['user.messages.*']) }}" href="{{ route('user.messages.index') }}"><i
                    class="far fa-comments"></i> Tin Nhắn</a></li>
        <li><a class="{{ setActive(['user.profile']) }}" href="{{ route('user.profile') }}"><i
                    class="far fa-user"></i>
                Thông tin tài khoản</a></li>
        <li><a class="{{ setActive(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="far fa-map"></i> Địa chỉ</a></li>
        @if (auth()->user()->role !== 'vendor')
            <li><a class="{{ setActive(['user.vendor-request.*']) }}"
                    href="{{ route('user.vendor-request.index') }}"><i class="far fa-user-plus"></i> Đăng ký trở thành
                    gian
                    hàng</a>
        @endif
        </li>
        @if (auth()->user()->role == 'vendor')
            <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                        class="far fa-angle-right"></i> Đi đến gian hàng</a>
        @endif
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
          this.closest('form').submit();" class="mt-4 bg-danger"><i
                        class="far fa-sign-out-alt"></i> Đăng xuất</a>
            </form>

        </li>
    </ul>
</div>
