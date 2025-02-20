@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thống Kê</h1>
        </div>

        <div>
            <div class="card-header">
                <h6>Doanh thu</h6>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng doanh thu từ tất cả đơn hàng đã giao</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($subTotals) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng tiền khuyến mãi khi dùng mã giảm giá</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($amountSale) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12"></div>
                {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Doanh thu đơn hàng đã giao sau khi trừ khuyến mãi</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($amount) }}
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng doanh thu từ các sản phẩm của MegaMart</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($totalEarningsAdminVendor) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng doanh thu của các gian hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($totalEarningsVendor) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng doanh thu từ hoa hồng của các gian hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($totalEarningsOtherVendors) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng doanh thu MegaMart nhận được</h4>
                            </div>
                            <div class="card-body">
                                {{ formatMoney($finalTotalEarnings - $amountSale) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Danh mục</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Danh mục cấp 1</h4>
                            </div>
                            <div class="card-body">
                                {{ $categories }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Danh mục cấp 2</h4>
                            </div>
                            <div class="card-body">
                                {{ $subCategories }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Danh mục cấp 3</h4>
                            </div>
                            <div class="card-body">
                                {{ $childCategories }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <div class="card-header">
                <h6>Sản phẩm</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Thương Hiệu</h4>
                            </div>
                            <div class="card-body">
                                {{ $brands }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                {{ $products }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng sản phẩm của MegaMart</h4>
                            </div>
                            <div class="card-body">
                                {{ $productsAdmin }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng sản phẩm của Người bán</h4>
                            </div>
                            <div class="card-body">
                                {{ $productsVendor }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng sản phẩm chờ duyệt</h4>
                            </div>
                            <div class="card-body">
                                {{ $productsPending }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Khuyến mãi</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Số sản phẩm Flash Sale</h4>
                            </div>
                            <div class="card-body">
                                {{ $flashSales }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Mã giảm giá</h4>
                            </div>
                            <div class="card-body">
                                {{ $coupons }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Đơn hàng</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đang xử lý</h4>
                            </div>
                            <div class="card-body">
                                {{ $pending_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-luggage-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng sẵn sàng ược vận chuyển</h4>
                            </div>
                            <div class="card-body">
                                {{ $processed_and_ready_to_ship_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-people-carry"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đã đến kho vận chuyển</h4>
                            </div>
                            <div class="card-body">
                                {{ $dropped_off_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đã được vận chuyển i</h4>
                            </div>
                            <div class="card-body">
                                {{ $shipped_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đang giao đến khách hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $out_for_delivery_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đã được giao</h4>
                            </div>
                            <div class="card-body">
                                {{ $delivered_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng đã bị hủy</h4>
                            </div>
                            <div class="card-body">
                                {{ $cancelled_orders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Đơn hàng hoàn trả</h4>
                            </div>
                            <div class="card-body">
                                {{ $refunded_orders }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Người dùng</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số người dùng</h4>
                            </div>
                            <div class="card-body">
                                {{ $users }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Khách hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $customers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Gian hàng</h4>
                            </div>
                            <div class="card-body">
                                {{ $vendors }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Gian hàng chờ duyệt</h4>
                            </div>
                            <div class="card-body">
                                {{ $vendorsPending }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Đánh giá</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số đánh giá</h4>
                            </div>
                            <div class="card-body">
                                {{ $reviews }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-header">
                <h6>Bài viết</h6>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tổng số bài viết</h4>
                            </div>
                            <div class="card-body">
                                {{ $blogs }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="card-header">
                <h6>Biểu đồ doanh thu và đơn hàng của toàn hệ thống</h6>
            </div>
            <form method="GET" class="d-flex align-items-center gap-3 my-3">
                <label for="year">Chọn năm:</label>
                <select class="form-control w-25 ml-2" name="year" id="year">
                    @foreach (range(\Carbon\Carbon::now()->year - 4, \Carbon\Carbon::now()->year) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary ml-2" type="submit">Xem</button>
            </form>
            <div class="row">
                <!-- Biểu ồ doanh thu -->
                <div class="col-xl-6">
                    <div class="wsus__dashboard_item">
                        <canvas id="monthlyRevenueChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Biểu ồ số ơn hàng -->
                <div class="col-xl-6">
                    <div class="wsus__dashboard_item">
                        <canvas id="monthlyOrdersChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card-header">
                    <h6>Sản phẩm bán chạy</h6>
                </div>
                <div class="row">

                    @foreach ($topSellingProducts as $item)
                        <div class="col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon">
                                    <img src="{{ asset($item['product']->thumb_image) }}" alt=""
                                        style="width: 80px; height: 80px;">
                                </div>
                                <div class="card-wrap ml-3">
                                    <div class="card-header">
                                        <h5>{{ $item['product']->name }}</h5>
                                    </div>
                                    <div class="card-body d-flex justify-content-between p-0 pr-3">
                                        <h6>{{ $item['vendor_name'] }}</h6>
                                        <h6>Đã bán: {{ $item['total_sales'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-4 mx-auto">
                <div class="card-header mb-3">
                    <h6>Biểu đồ số đánh giá</h6>
                </div>
                <canvas id="ratingChart"></canvas>
            </div>
        </div>


        {{-- <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistics</h4>
                        <div class="card-header-action">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="182"></canvas>
                        <div class="statistic-details mt-sm-4">
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                    7%</span>
                                <div class="detail-value">$243</div>
                                <div class="detail-name">Today's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                    23%</span>
                                <div class="detail-value">$2,902</div>
                                <div class="detail-name">This Week's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span>9%</span>
                                <div class="detail-value">$12,821</div>
                                <div class="detail-name">This Month's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                    19%</span>
                                <div class="detail-value">$92,142</div>
                                <div class="detail-name">This Year's Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Activities</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="float-right text-primary">Now</div>
                                    <div class="media-title">Farhan A Mujib</div>
                                    <span class="text-small text-muted">Cras sit amet nibh libero, in
                                        gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="float-right">12m</div>
                                    <div class="media-title">Ujang Maman</div>
                                    <span class="text-small text-muted">Cras sit amet nibh libero, in
                                        gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-3.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="float-right">17m</div>
                                    <div class="media-title">Rizal Fakhri</div>
                                    <span class="text-small text-muted">Cras sit amet nibh libero, in
                                        gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="float-right">21m</div>
                                    <div class="media-title">Alfa Zulkarnain</div>
                                    <span class="text-small text-muted">Cras sit amet nibh libero, in
                                        gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center pt-1 pb-1">
                            <a href="#" class="btn btn-primary btn-lg btn-round">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Referral URL</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                            <div class="font-weight-bold mb-1">Google</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                            <div class="font-weight-bold mb-1">Facebook</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                            <div class="font-weight-bold mb-1">Bing</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">884</div>
                            <div class="font-weight-bold mb-1">Yahoo</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">473</div>
                            <div class="font-weight-bold mb-1">Kodinger</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="28%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-small float-right font-weight-bold text-muted">418</div>
                            <div class="font-weight-bold mb-1">Multinity</div>
                            <div class="progress" data-height="3">
                                <div class="progress-bar" role="progressbar" data-width="20%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Popular Browser</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <div class="browser browser-chrome"></div>
                                <div class="mt-2 font-weight-bold">Chrome</div>
                                <div class="text-muted text-small"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 48%</div>
                            </div>
                            <div class="col text-center">
                                <div class="browser browser-firefox"></div>
                                <div class="mt-2 font-weight-bold">Firefox</div>
                                <div class="text-muted text-small"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 26%</div>
                            </div>
                            <div class="col text-center">
                                <div class="browser browser-safari"></div>
                                <div class="mt-2 font-weight-bold">Safari</div>
                                <div class="text-muted text-small"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 14%</div>
                            </div>
                            <div class="col text-center">
                                <div class="browser browser-opera"></div>
                                <div class="mt-2 font-weight-bold">Opera</div>
                                <div class="text-muted text-small">7%</div>
                            </div>
                            <div class="col text-center">
                                <div class="browser browser-internet-explorer"></div>
                                <div class="mt-2 font-weight-bold">IE</div>
                                <div class="text-muted text-small"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 5%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-sm-5 mt-md-0">
                    <div class="card-header">
                        <h4>Visitors</h4>
                    </div>
                    <div class="card-body">
                        <div id="visitorMap"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>This Week Stats</h4>
                        <div class="card-header-action">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-primary"
                                    data-toggle="dropdown">Filter</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        Electronic</a>
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        T-shirt</a>
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i>
                                        Hat</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-info">
                                <h4>$1,053</h4>
                                <div class="text-muted">Sold 3 items on 2 customers</div>
                                <div class="d-block mt-2">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                            <div class="summary-item">
                                <h6>Item List <span class="text-muted">(3 Items)</span></h6>
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="assets/img/products/product-1-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$405</div>
                                            <div class="media-title"><a href="#">PlayStation 9</a>
                                            </div>
                                            <div class="text-muted text-small">by <a href="#">Hasan
                                                    Basri</a>
                                                <div class="bullet"></div> Sunday
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="assets/img/products/product-2-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$499</div>
                                            <div class="media-title"><a href="#">RocketZ</a></div>
                                            <div class="text-muted text-small">by <a href="#">Hasan
                                                    Basri</a>
                                                <div class="bullet"></div> Sunday
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#">
                                            <img class="mr-3 rounded" width="50"
                                                src="assets/img/products/product-3-50.png" alt="product">
                                        </a>
                                        <div class="media-body">
                                            <div class="media-right">$149</div>
                                            <div class="media-title"><a href="#">Xiaomay Readme
                                                    4.0</a></div>
                                            <div class="text-muted text-small">by <a href="#">Kusnaedi</a>
                                                <div class="bullet"></div> Tuesday
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-inline">Tasks</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cbx-1">
                                    <label class="custom-control-label" for="cbx-1"></label>
                                </div>
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="badge badge-pill badge-danger mb-1 float-right">Not
                                        Finished</div>
                                    <h6 class="media-title"><a href="#">Redesign header</a></h6>
                                    <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div> <span
                                            class="text-primary">Now</span>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cbx-2" checked="">
                                    <label class="custom-control-label" for="cbx-2"></label>
                                </div>
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="badge badge-pill badge-primary mb-1 float-right">Completed
                                    </div>
                                    <h6 class="media-title"><a href="#">Add a new component</a></h6>
                                    <div class="text-small text-muted">Serj Tankian <div class="bullet">
                                        </div> 4 Min</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cbx-3">
                                    <label class="custom-control-label" for="cbx-3"></label>
                                </div>
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="badge badge-pill badge-warning mb-1 float-right">Progress
                                    </div>
                                    <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                                    <div class="text-small text-muted">Ujang Maman <div class="bullet">
                                        </div> 8 Min</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cbx-4">
                                    <label class="custom-control-label" for="cbx-4"></label>
                                </div>
                                <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png"
                                    alt="avatar">
                                <div class="media-body">
                                    <div class="badge badge-pill badge-danger mb-1 float-right">Not
                                        Finished</div>
                                    <h6 class="media-title"><a href="#">Remove unwanted classes</a>
                                    </h6>
                                    <div class="text-small text-muted">Farhan A Mujib <div class="bullet">
                                        </div> 21 Min</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Draft</h4>
                        </div>
                        <div class="card-body pb-0">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please fill in the title
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="summernote-simple"></textarea>
                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <button class="btn btn-primary">Save Draft</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Posts</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Introduction Laravel 5
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Installation
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - MVC
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Migration
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Deploy
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Laravel 5 Tutorial - Closing
                                            <div class="table-links">
                                                in <a href="#">Web Development</a>
                                                <div class="bullet"></div>
                                                <a href="#">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="font-weight-600"><img
                                                    src="assets/img/avatar/avatar-1.png" alt="avatar" width="30"
                                                    class="rounded-circle mr-1"> Bagus Dwi
                                                Cahya</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Biểu ồ doanh thu
            var ctxRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
            var chartRevenue = new Chart(ctxRevenue, {
                type: 'bar',
                data: {
                    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    datasets: [{
                        label: 'Doanh thu',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        data: [
                            @foreach (range(1, 12) as $month)
                                {{ $monthlyEarnings[$month] ?? 0 }},
                            @endforeach
                        ],
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    return value.toLocaleString('en-US') + '';
                                }
                            }
                        }]
                    },
                    hover: {
                        animationDuration: 0 // Tắt hiệu ứng zoom khi hover
                    },
                    animation: {
                        duration: 0 // Tắt toàn bộ animation
                    }
                }
            });

            // Biểu ồ số ơn hàng
            var ctxOrders = document.getElementById('monthlyOrdersChart').getContext('2d');
            var chartOrders = new Chart(ctxOrders, {
                type: 'bar',
                data: {
                    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    datasets: [{
                        label: 'Số đơn hàng',
                        backgroundColor: 'rgba(255, 159, 64, 0.5)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        data: [
                            @foreach (range(1, 12) as $month)
                                {{ $monthlyOrders[$month] ?? 0 }},
                            @endforeach
                        ],
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    },
                }
            });

            var ctxRating = document.getElementById('ratingChart').getContext('2d');
            var chartRating = new Chart(ctxRating, {
                type: 'pie',
                data: {
                    labels: ['1 Sao', '2 Sao', '3 Sao', '4 Sao', '5 Sao'],
                    datasets: [{
                        data: [
                            {{ $ratings[1] ?? 0 }},
                            {{ $ratings[2] ?? 0 }},
                            {{ $ratings[3] ?? 0 }},
                            {{ $ratings[4] ?? 0 }},
                            {{ $ratings[5] ?? 0 }},
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>
@endpush
