<div class="dashboard_sidebar z-index" style="background-color: #0b2c3d">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('vendor.dashboard') }}" class="dash_logo p-3 bg-white">
        <img src="{{ asset('logo_transparent.png') }}" width="140px" alt="logo" class="img-fluid">
        <p class="mt-2 ">Gian hàng</p>
    </a>
    <ul class="dashboard_link">
        <li><a class="mb-4 bg-dark" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i>Quay
                về Trang
                chủ</a>
        </li>
        <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Thống Kê</a></li>
        <li><a class="{{ setActive(['vendor.products.*', 'vendor.product-variant.*', 'vendor.product-variant-item.*']) }}"
                href="{{ route('vendor.products.index') }}"><i class="far fa-layer-group"></i>
                Quản lý sản phẩm</a>
        </li>
        <li><a class="{{ setActive(['vendor.orders.*']) }}" href="{{ route('vendor.orders.index') }}"><i
                    class="far fa-scroll"></i> Quản lý đơn hàng</a></li>
        <li><a class="{{ setActive(['vendor.reviews.*']) }}" href="{{ route('vendor.reviews.index') }}"><i
                    class="far fa-star"></i> Quản lý đánh giá</a></li>
        <li><a class="{{ setActive(['vendor.withdraw.*']) }}" href="{{ route('vendor.withdraw.index') }}"><i
                    class="far fa-coins"></i> Quản lý thanh toán</a></li>
        <li><a class="{{ setActive(['vendor.messages.*']) }}" href="{{ route('vendor.messages.index') }}"><i
                    class="far fa-comments"></i> Tin nhắn</a></li>
        <li><a class="{{ setActive(['vendor.shop-profile.index']) }}"
                href="{{ route('vendor.shop-profile.index') }}"><i class="far fa-hotel"></i> Thông tin gian hàng</a>
        </li>
        <li><a class="{{ setActive(['vendor.profile']) }}" href="{{ route('vendor.profile') }}"><i
                    class="far fa-user"></i> Thông tin tài khoản</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();"
                    class="mt-4 bg-danger"><i class="far fa-sign-out-alt"></i> Đăng xuất</a>
            </form>

        </li>
    </ul>
</div>
