<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">
                <img width="100px" src="{{ asset('logo.png') }}" alt="">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            {{-- <li class="menu-header">Dashboard</li> --}}
            <li class="{{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Thống
                        kê</span></a>
            </li>
            {{-- <li class="menu-header">Starter</li> --}}
            <li
                class="dropdown {{ setActive(['admin.slider.*', 'admin.home-page-setting.*', 'admin.vendor-condition.*', 'admin.about.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Quản Lý Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                    <li class="{{ setActive(['admin.home-page-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting.index') }}">Cài đặt trang chủ</a></li>
                    <li class="{{ setActive(['admin.vendor-condition.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-condition.index') }}">Điều khoản gian hàng</a></li>
                    <li class="{{ setActive(['admin.about.*']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">Giới thiệu trang web</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>Quản Lý Danh Mục</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Danh mục cấp 1</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Danh mục cấp 2</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Danh mục cấp 3</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.brand.*', 'admin.products.index', 'admin.seller-products.*', 'admin.seller-pending-products.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-layer-group"></i>
                    <span>Quản Lý Sản Phẩm</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Thương hiệu</a></li>
                    <li class="{{ setActive(['admin.products.index']) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Sản phẩm của MegaMart</a>
                    </li>
                    <li class="{{ setActive(['admin.seller-products.index']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}">Sản phẩm của người bán</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.index']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}">Sản phẩm đang chờ duyệt</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.shipping-rule.*', 'admin.payment-settings.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-shopping-cart"></i>
                    <span>Quản Lý Bán Hàng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Thông tin MegaMart</a></li>
                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Thông tin vận chuyển</a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-settings.index') }}">Thông tin thanh toán</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.flash-sale.*', 'admin.coupons.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-calendar-check"></i>
                    <span>Quản Lý Khuyến Mãi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Mã giảm giá</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.order.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-scroll"></i>
                    <span>Quản Lý Đơn Hàng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.index', 'admin.order.show']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">Tất cả đơn hàng</a></li>
                    <li class="{{ setActive(['admin.order.cancel-orders', 'admin.order.cancel-orders-show']) }}"><a
                            class="nav-link" href="{{ route('admin.order.cancel-orders') }}">Đơn hàng đã huỷ</a></li>

                </ul>
            </li>

            {{-- <li class="dropdown {{ setActive(['admin.footer-info.*', 'admin.footer-grid-two.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-link"></i>
                    <span>Quản Lý Chân Trang</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}">Thông tin liên hệ</a></li>
                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}">Nội dung chân trang</a></li>

                </ul>
            </li> --}}

            <li
                class="dropdown {{ setActive(['admin.vendor-requests.*', 'admin.customers.*', 'admin.vendor-list.*', 'admin.manage-user.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Quản Lý Người Dùng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-requests.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-requests.index') }}">Gian hàng đang chờ duyệt</a></li>
                    <li class="{{ setActive(['admin.customers.*']) }}"><a class="nav-link"
                            href="{{ route('admin.customers.index') }}">Khách hàng</a></li>
                    <li class="{{ setActive(['admin.vendor-list.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-list.index') }}">Gian hàng</a></li>
                    <li class="{{ setActive(['admin.manage-user.*']) }}"><a class="nav-link"
                            href="{{ route('admin.manage-user.index') }}">Tài khoản</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.withdraw-method.*', 'admin.withdraw-list.*', 'admin.withdraw.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-coins"></i>
                    <span>Quản Lý Rút Tiền</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.withdraw-method.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-method.index') }}">Phương thức rút tiền</a></li>
                    <li class="{{ setActive(['admin.withdraw-list.*', 'admin.withdraw.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-list.index') }}">Yêu cầu rút tiền</a></li>

                </ul>
            </li>

            <li class="{{ setActive(['admin.messages.*']) }}">
                <a href="{{ route('admin.messages.index') }}" class="nav-link"><i
                        class="fas fa-comments"></i><span>Tin Nhắn</span></a>
            </li>

            {{-- <li class="{{ setActive(['admin.transactions.*']) }}">
                <a href="{{ route('admin.transactions.index') }}" class="nav-link"><i
                        class="fas fa-money-check"></i><span>Lịch
                        Sử Thanh Toán</span></a>
            </li> --}}

            {{-- <li class="{{ setActive(['admin.subscribers.*']) }}">
                <a href="{{ route('admin.subscribers.index') }}" class="nav-link"><i
                        class="fas fa-paper-plane"></i><span>Người Đăng Ký Nhận Tin</span></a>
            </li> --}}

            <li class="{{ setActive(['admin.reviews.*']) }}">
                <a href="{{ route('admin.reviews.index') }}" class="nav-link"><i class="fas fa-star"></i><span>Quản
                        Lý Đánh Giá</span></a>
            </li>

            <li class="{{ setActive(['admin.advertisement.*']) }}">
                <a href="{{ route('admin.advertisement.index') }}" class="nav-link"><i
                        class="fas fa-ad"></i><span>Quản
                        Lý Quảng Cáo</span></a>
            </li>

            <li class="{{ setActive(['admin.blog.*']) }}">
                <a href="{{ route('admin.blog.index') }}" class="nav-link"><i
                        class="fas fa-newspaper"></i><span>Quản Lý Bài Viết</span></a>
            </li>

            <li class="{{ setActive(['admin.reports.*']) }}">
                <a href="{{ route('admin.reports.index') }}" class="nav-link"><i
                        class="fas fa-chart-line"></i><span>Báo
                        cáo</span></a>
            </li>

            {{-- <li class="{{ setActive(['admin.setting.*']) }}">
                <a href="{{ route('admin.setting.index') }}" class="nav-link"><i class="fas fa-cog"></i><span>Cài
                        đặt</span></a>
            </li> --}}

        </ul>

    </aside>
</div>
