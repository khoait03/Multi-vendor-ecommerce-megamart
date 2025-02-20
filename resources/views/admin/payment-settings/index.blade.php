@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thông Tin Thanh Toán</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Bán Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Thông Tin Thanh Toán</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cài Đặt Thông Tin Thanh Toán</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" role="tab">Thanh toán Paypal</a>
                                        <a class="list-group-item list-group-item-action" id="list-stripe-list"
                                            data-toggle="list" href="#list-stripe" role="tab">Thanh toán Stripe</a>
                                        <a class="list-group-item list-group-item-action" id="list-vnpay-list"
                                            data-toggle="list" href="#list-vnpay" role="tab">Thanh toán VNPay</a>
                                        <a class="list-group-item list-group-item-action" id="list-cod-list"
                                            data-toggle="list" href="#list-cod" role="tab">Thanh toán khi nhận hàng
                                            (COD)</a>
                                        {{-- <a class="list-group-item list-group-item-action" id="list-profile-list"
                                            data-toggle="list" href="#list-profile" role="tab">Profile</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                            data-toggle="list" href="#list-messages" role="tab">Messages</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-settings" role="tab">Settings</a> --}}
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.payment-settings.sections.paypal-setting')

                                        @include('admin.payment-settings.sections.stripe-setting')

                                        @include('admin.payment-settings.sections.cod-setting')

                                        @include('admin.payment-settings.sections.vnpay-setting')


                                        {{-- <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">
                                            In quis non esse eiusmod sunt fugiat magna pariatur officia anim ex officia
                                            nostrud amet nisi pariatur eu est id ut exercitation ex ad reprehenderit dolore
                                            nostrud sit ut culpa consequat magna ad labore proident ad qui et tempor
                                            exercitation in aute veniam et velit dolore irure qui ex magna ex culpa enim
                                            anim ea mollit consequat ullamco exercitation in.
                                        </div> --}}
                                        {{-- <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                            aria-labelledby="list-settings-list">
                                            Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam
                                            commodo elit dolore do labore occaecat laborum sed quis proident fugiat sunt
                                            pariatur. Cupidatat ut fugiat anim ut dolore excepteur ut voluptate dolore
                                            excepteur mollit commodo.
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
