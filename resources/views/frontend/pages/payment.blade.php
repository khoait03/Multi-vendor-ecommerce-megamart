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
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                {{-- <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true">card payment</button> --}}
                                <button class="nav-link border-0 bg-transparent active " id="v-pills-paypal-tab"
                                    data-bs-toggle="pill" data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">
                                    <img src="{{ asset('paypal.webp') }}" alt="" width="100px">
                                </button>
                                <button class="nav-link border-0 bg-transparent" id="v-pills-stripe-tab"
                                    data-bs-toggle="pill" data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">
                                    <img src="{{ asset('stripe.png') }}" alt="" width="100px">
                                </button>
                                <button class="nav-link border-0 bg-transparent" id="v-pills-stripe-tab"
                                    data-bs-toggle="pill" data-bs-target="#v-pills-vnpay" type="button" role="tab"
                                    aria-controls="v-pills-vnpay" aria-selected="false">
                                    <img src="{{ asset('vnpay.png') }}" alt="" width="120px">
                                </button>
                                <button class="nav-link border-0 bg-transparent" id="v-pills-stripe-tab"
                                    data-bs-toggle="pill" data-bs-target="#v-pills-cod" type="button" role="tab"
                                    aria-controls="v-pills-cod" aria-selected="false">
                                    <img src="{{ asset('cod.png') }}" alt="" width="130px">
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            {{-- <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-paypal-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <form>
                                                <div class="wsus__pay_caed_header">
                                                    <h5>credit or debit card</h5>
                                                    <img src="images/payment5.png" alt="payment" class="img-=fluid">
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input class="input" type="text"
                                                            placeholder="MD. MAHAMUDUL HASSAN SAZAL">
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="input" type="text"
                                                            placeholder="2540 4587 **** 3215">
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="input" type="text" placeholder="MM/YY">
                                                    </div>
                                                    <div class="col-4 ms-auto">
                                                        <input class="input" type="text" placeholder="1234">
                                                    </div>
                                                </div>
                                                <div class="wsus__save_payment">
                                                    <h6><i class="fas fa-user-lock"></i> 100% secure payment with :</h6>
                                                    <img src="images/payment1.png" alt="payment" class="img-fluid">
                                                    <img src="images/payment2.png" alt="payment" class="img-fluid">
                                                    <img src="images/payment3.png" alt="payment" class="img-fluid">
                                                </div>
                                                <div class="wsus__save_card">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">save
                                                            thid Card</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="common_btn">confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-paypal-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a href="{{ route('user.paypal.payment') }}"
                                                class="nav-link bg-primary text-light rounded text-center">Thanh toán với
                                                Paypal ngay!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('frontend.pages.payment-gateway.stripe')

                            @include('frontend.pages.payment-gateway.cod')

                            <div class="tab-pane fade show" id="v-pills-vnpay" role="tabpanel"
                                aria-labelledby="v-pills-vnpay-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">

                                            <form action="{{ route('user.vnpay.payment') }}" method="POST">
                                                @csrf

                                                <button type="submit" name="redirect"
                                                    class="nav-link bg-success text-light rounded text-center border-0">Thanh
                                                    toán với
                                                    VNPay ngay!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="wsus__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div> --}}

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Thông tin thanh toán</h5>
                            <p>Tiền đơn hàng: <span id="sub-total">{{ formatMoney(getCartTotal()) }}</span></p>
                            <p>Phí vận chuyển: <span id="shipping-fee">+ {{ formatMoney(getShippingFee()) }}</span></p>
                            <p>Giảm giá: <span id="discount">- {{ formatMoney(getCartDiscount()) }}</span></p>
                            <p class="total"><span><strong>Tổng tiền:</strong></span> <span id="cart-total"><strong
                                        id="total-amount"
                                        data-id="{{ getMainCartTotal() }}">{{ formatMoney(getPayableAmount()) }}</strong></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
