@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Thanh toán
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Thanh toán</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Giỏ hàng</a></li>
                            <li><a href="#">Thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__checkout_form">
                <div class="row">
                    <div class="col-xl-9 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Thông tin địa chỉ <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Thêm địa chỉ mới</a></h5>

                            <div class="row">

                                @foreach ($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input shipping-address"
                                                    data-id="{{ $address->id }}" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Chọn địa chỉ này
                                                </label>
                                            </div>
                                            <ul>
                                                <li><span><strong>Họ và tên :</strong></span> {{ $address->name }}</li>
                                                <li><span><strong>Điện thoại :</strong></span> {{ $address->phone }}</li>
                                                <li><span><strong>Email :</strong></span> {{ $address->email }}</li>
                                                <li><span><strong>Tỉnh/Thành Phố :</strong></span>
                                                    {{ $address->province_city }}
                                                </li>
                                                <li><span><strong>Quận/Huyện :</strong></span> {{ $address->district }}</li>
                                                <li><span><strong>Xã/Phường :</strong></span> {{ $address->commune_ward }}
                                                </li>
                                                <li><span><strong>Số nhà, căn hộ :</strong></span> {{ $address->address }}
                                                </li>
                                                <li><span><strong>Yêu cầu khác :</strong></span> {{ $address->other }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <h5 class="mt-5">Thông tin đơn hàng</h5>
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
                                                </th>
                                            </tr>

                                            @foreach ($cartItems as $item)
                                                <tr class="d-flex">
                                                    <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}"
                                                            alt="product" class="img-fluid w-50">
                                                    </td>

                                                    <td class="wsus__pro_name">
                                                        <p>{{ $item->name }}</p>

                                                        @foreach ($item->options->variants as $key => $variant)
                                                            <span>{{ $key }}: {{ $variant['name'] }}
                                                                {{ $variant['price'] > 0 ? '(+' . formatMoney($variant['price']) . ')' : '' }}</span>
                                                        @endforeach

                                                    </td>

                                                    <td class="wsus__pro_status">
                                                        <p>{{ formatMoney($item->price + $item->options->variants_total) }}
                                                        </p>
                                                    </td>

                                                    <td class="wsus__pro_select">
                                                        <div class="product-quantity-wrapper">

                                                            <input class="product-quantity" name="quantity" type="number"
                                                                value="{{ $item->options->stock == 0 ? 0 : $item->qty }}"
                                                                readonly />

                                                        </div>
                                                    </td>

                                                    <td class="wsus__pro_tk">
                                                        <h6 id="{{ $item->rowId }}">
                                                            {{ formatMoney(($item->price + $item->options->variants_total) * $item->qty) }}
                                                        </h6>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">Phương thức vận chuyển</p>

                            @foreach ($shippingMethods as $method)
                                @if ($method->type == 'min_cost' && getCartTotal() >= $method->min_cost)
                                    <div class="form-check">
                                        <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                            id="exampleRadios1" data-id="{{ $method->cost }}" value="{{ $method->id }}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{ $method->name }}
                                            <span>(Phí vận chuyển: {{ formatMoney($method->cost) }}, từ 3-5 ngày)</span>
                                        </label>
                                    </div>
                                @elseif ($method->type == 'flat_cost')
                                    <div class="form-check">
                                        <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                            id="exampleRadios1" data-id="{{ $method->cost }}" value="{{ $method->id }}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{ $method->name }}
                                            <span>(Phí vận chuyển: {{ formatMoney($method->cost) }}, từ 3-5 ngày)</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                            <div class="wsus__order_details_summery">
                                <p>Tiền đơn hàng: <span id="sub-total">{{ formatMoney(getCartTotal()) }}</span></p>
                                <p>Phí vận chuyển: <span id="shipping-fee">+ 0 ₫</span></p>
                                <p>Giảm giá: <span id="discount">- {{ formatMoney(getCartDiscount()) }}</span></p>
                                <p class="total"><span><strong>Tổng tiền:</strong></span> <span id="cart-total"><strong
                                            id="total-amount"
                                            data-id="{{ getMainCartTotal() }}">{{ formatMoney(getMainCartTotal()) }}</strong></span>
                                </p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input agree-term" type="checkbox" value=""
                                        id="flexCheckChecked3" checked>
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        Tôi đã xem và đồng ý với <a href="#">quy định và điều khoản của website *</a>
                                    </label>
                                </div>
                            </div>
                            <form action="" id="checkoutForm">
                                <input type="hidden" id="shipping_method_id" name="shipping_method_id" value="">
                                <input type="hidden" id="shipping_address_id" name="shipping_address_id" value="">
                            </form>
                            <button id="submitCheckoutForm" class="common_btn">Thanh Toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm địa chỉ mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.address.create') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Họ và tên <b>*</b></label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Nguyễn Văn A" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Email <b>*</b></label>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="example@gmail.com" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Điện thoại <b>*</b></label>
                                            <input class="form-control" type="text" name="phone"
                                                placeholder="0123456789" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('phone') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Tỉnh/Thành Phố <b>*</b></label>

                                            <select class="form-select" id="tinh" name="province_city_name"
                                                title="Chọn Tỉnh Thành">
                                                <option value="">Tỉnh Thành</option>
                                            </select>

                                            @if ($errors->has('province_city_name'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('province_city_name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Quận/Huyện <b>*</b></label>

                                            <select class="form-select" id="quan" name="district_name"
                                                title="Chọn Quận Huyện">
                                                <option value="">Quận Huyện</option>
                                            </select>

                                            @if ($errors->has('district_name'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('district_name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Phường/Xã <b>*</b></label>

                                            <select class="form-select" id="phuong" name="commune_ward_name"
                                                title="Chọn Phường Xã">
                                                <option value="">Phường Xã</option>
                                            </select>

                                            @if ($errors->has('commune_ward_name'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('commune_ward_name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Số nhà, tên đường <b>*</b></label>
                                            <input class="form-control" type="text" name="address" placeholder="..."
                                                value="{{ old('address') }}">
                                            @if ($errors->has('address'))
                                                <p class="text-danger d-flex justify-content-end mt-1">
                                                    {{ $errors->first('address') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold h6">Yêu cầu khác (Không bắt buộc)</label>
                                            <input class="form-control" type="text" name="other" placeholder="..."
                                                value="{{ old('other') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <button type="submit" class="common_btn">Tạo mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Lấy tỉnh thành
            $.getJSON('/fetch-tinhthanh/1/0', function(data_tinh) {
                if (data_tinh.error == 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh
                            .full_name + '</option>');
                    });
                    $("#tinh").change(function(e) {
                        var idtinh = $(this).val();
                        // Lấy quận huyện
                        $.getJSON('/fetch-tinhthanh/2/' + idtinh, function(data_quan) {
                            if (data_quan.error == 0) {
                                $("#quan").html('<option value="0">Quận Huyện</option>');
                                $("#phuong").html('<option value="0">Phường Xã</option>');
                                $.each(data_quan.data, function(key_quan, val_quan) {
                                    $("#quan").append('<option value="' + val_quan
                                        .id + '">' + val_quan.full_name +
                                        '</option>');
                                });
                                // Lấy phường xã
                                $("#quan").change(function(e) {
                                    var idquan = $(this).val();
                                    $.getJSON('/fetch-tinhthanh/3/' + idquan,
                                        function(data_phuong) {
                                            if (data_phuong.error == 0) {
                                                $("#phuong").html(
                                                    '<option value="0">Phường Xã</option>'
                                                );
                                                $.each(data_phuong.data,
                                                    function(key_phuong,
                                                        val_phuong) {
                                                        $("#phuong").append(
                                                            '<option value="' +
                                                            val_phuong
                                                            .id + '">' +
                                                            val_phuong
                                                            .full_name +
                                                            '</option>');
                                                    });
                                            }
                                        });
                                });

                            }
                        });
                    });

                }
            });

            // Xử lý khi form được submit
            $('form').submit(function(e) {
                // Đổi giá trị của các thẻ select thành tên
                var province = $('#tinh option:selected').text();
                var district = $('#quan option:selected').text();
                var commune = $('#phuong option:selected').text();

                $('#tinh').append('<input type="hidden" name="province_city" value="' + province + '">');
                $('#quan').append('<input type="hidden" name="district" value="' + district + '">');
                $('#phuong').append('<input type="hidden" name="commune_ward" value="' + commune + '">');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function customFormatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(".", ",");
            }

            $(".shipping-method").on("click", function() {
                $("#shipping_method_id").val($(this).val())
                $("#shipping-fee").text("+ " + customFormatNumber($(this).data("id")) + " ₫")
                let toralAmount = $("#total-amount").data("id")
                $("#total-amount").text(customFormatNumber(toralAmount + $(this).data("id")) + " ₫")
            })

            $(".shipping-address").on("click", function() {
                $("#shipping_address_id").val($(this).data("id"))
            })

            $("#submitCheckoutForm").on("click", function() {
                if ($("#shipping_address_id").val() == "") {
                    toastr.error("Vui lòng chọn địa chỉ giao hàng")
                } else if ($("#shipping_method_id").val() == "") {
                    toastr.error("Vui lòng chọn phương thức vận chuyển")
                } else if (!$(".agree-term").prop("checked")) {
                    toastr.error("Vui lòng click chọn đồng ý quy định, điều khoản")
                } else {
                    $.ajax({
                        url: "{{ route('user.checkout.form-submit') }}",
                        method: "POST",
                        data: $("#checkoutForm").serialize(),
                        beforeSend: function() {
                            $("#submitCheckoutForm").html(
                                "<i class='fas fa-spinner fa-spin fa-2x'></i>")
                        },
                        success: function(data) {
                            $("#submitCheckoutForm").html("Thanh Toán")
                            window.location.href = data.redirect_url
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                }


            })
        })
    </script>
@endpush
