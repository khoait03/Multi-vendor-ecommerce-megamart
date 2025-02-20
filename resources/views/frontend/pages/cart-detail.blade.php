@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Giỏ hàng
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Giỏ hàng</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Giỏ hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Hình ảnh
                                        </th>

                                        <th class="wsus__pro_name">
                                            Thông tin sản phẩm
                                        </th>

                                        <th class="wsus__pro_status">
                                            Đơn giá
                                        </th>

                                        <th class="wsus__pro_select">
                                            Số lượng
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Thành tiền
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <button class="common_btn clear-cart">Xoá hết</button>
                                        </th>
                                    </tr>

                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}"
                                                    alt="product" class="img-fluid w-75">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{{ $item->name }}</p>

                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }}: {{ $variant['name'] }}
                                                        {{ $variant['price'] > 0 ? '(+' . formatMoney($variant['price']) . ')' : '' }}</span>
                                                @endforeach

                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>{{ formatMoney($item->price + $item->options->variants_total) }}</p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product-quantity-wrapper">
                                                    <button class="btn btn-danger product-decrement"><i class="fas fa-minus"
                                                            style="font-size: 12px"></i></button>
                                                    <input class="product-quantity" name="quantity" type="number"
                                                        min="1"
                                                        max="{{ $item->options->stock == 0 ? 1 : $item->options->stock }}"
                                                        data-rowid="{{ $item->rowId }}"
                                                        value="{{ $item->options->stock == 0 ? 0 : $item->qty }}"
                                                        readonly />
                                                    <button class="btn btn-success product-increment"><i class="fas fa-plus"
                                                            style="font-size: 12px"></i></button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ formatMoney(($item->price + $item->options->variants_total) * $item->qty) }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.remove-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($cartItems) == 0)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" rowspan="2" style="width: 100%">
                                                Giỏ hàng đang trống
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>Thông tin thanh toán</h6>
                        <p>Tiền đơn hàng: <span id="sub-total">{{ formatMoney(getCartTotal()) }}</span></p>
                        {{-- <p>Phí vận chuyển: <span>$00.00</span></p> --}}
                        <p>Giảm giá: <span id="discount">- {{ formatMoney(getCartDiscount()) }}</span></p>
                        <p class="total"><span>Tổng tiền:</span> <span
                                id="cart-total">{{ formatMoney(getMainCartTotal()) }}</span>
                        </p>

                        <form id="coupon-form">
                            <input type="text" placeholder="Mã giảm giá" name="code"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}">
                            <button type="submit" class="common_btn">Nhập</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout') }}">Đặt hàng</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i> Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function customFormatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(".", ",");
            }

            $(".product-increment").on("click", function() {
                let input = $(this).siblings(".product-quantity");
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data("rowid")

                if (quantity > parseInt(input.attr("max"))) {
                    quantity = parseInt(input.attr("max"));
                }

                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: "POST",
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            let productId = "#" + rowId
                            let formattedTotal = customFormatNumber(data.product_total);
                            $(productId).text(formattedTotal + "đ");
                            renderCartSubTotal()
                            calculateCouponDiscount()
                            toastr.success(data.message)
                        }
                        if (data.status == "error") {
                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            $(".product-decrement").on("click", function() {
                let input = $(this).siblings(".product-quantity");
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data("rowid")

                if (quantity < 1) {
                    quantity = 1;
                }

                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: "POST",
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            let productId = "#" + rowId
                            let formattedTotal = customFormatNumber(data.product_total);
                            $(productId).text(formattedTotal + "đ");
                            renderCartSubTotal()
                            calculateCouponDiscount()
                            toastr.success(data.message)
                        }
                        if (data.status == "error") {
                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            $(".clear-cart").on("click", function(e) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xoá hết?',
                    text: "Dữ liệu không thể khôi phục sau khi xoá",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'GET',
                            url: "{{ route('clear-cart') }}",

                            success: function(data) {
                                if (data.status = "success") {
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })

            function renderCartSubTotal() {
                $.ajax({
                    method: "GET",
                    url: "{{ route('cart.cart-total') }}",
                    success: function(data) {
                        $("#sub-total").html(customFormatNumber(data) + " ₫")
                    },
                    error: function(data) {

                    }
                })
            }

            $("#coupon-form").on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: "{{ route('apply-coupon') }}",
                    data: formData,
                    success: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message)
                            calculateCouponDiscount()
                        }
                        if (data.status == "error") {
                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            function calculateCouponDiscount() {
                $.ajax({
                    method: "GET",
                    url: "{{ route('coupon-calculation') }}",
                    success: function(data) {
                        if (data.status == "success") {
                            $("#discount").text("- " + customFormatNumber(data.discount) + " ₫")
                            $("#cart-total").text(customFormatNumber(data.cart_total) + " ₫")
                        }
                        if (data.status == "error") {
                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            }

        })
    </script>
@endpush
