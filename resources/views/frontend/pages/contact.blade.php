@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Liên hệ
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Liên Hệ</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__contact">
        <div class="container">
            <div class="wsus__contact_area">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-envelope"></i>
                                    <h5>Email liên hệ</h5>
                                    <a>{{ @$settings->contact_email }}</a>
                                    <span><i class="fal fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="far fa-phone-alt"></i>
                                    <h5>Điện thoại liên hệ</h5>
                                    <a>{{ @$settings->contact_phone }}</a>
                                    <span><i class="far fa-phone-alt"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <h5>Địa chỉ liên hệ</h5>
                                    <a>{{ @$settings->contact_address }}</a>
                                    <span><i class="fal fa-map-marker-alt"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="wsus__contact_question">
                            <h5>Gửi liên lạc đến chúng tôi</h5>
                            <form id="contact-form" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Tên của bạn" name="name">
                                            @if ($errors->has('name'))
                                                <p class="text-danger d-flex justify-content-end">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Điện thoại" name="phone">
                                            @if ($errors->has('phone'))
                                                <p class="text-danger d-flex justify-content-end">
                                                    {{ $errors->first('phone') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="wsus__con_form_single">
                                            <input type="email" placeholder="Email" name="email">
                                            @if ($errors->has('email'))
                                                <p class="text-danger d-flex justify-content-end">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Tiêu đề liên hệ" name="subject">
                                            @if ($errors->has('subject'))
                                                <p class="text-danger d-flex justify-content-end">
                                                    {{ $errors->first('subject') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <textarea cols="3" rows="5" placeholder="Nội dung cần liên hệ" name="message"></textarea>
                                            @if ($errors->has('message'))
                                                <p class="text-danger d-flex justify-content-end">
                                                    {{ $errors->first('message') }}
                                                </p>
                                            @endif
                                        </div>
                                        <button type="submit" id="contact-btn" class="common_btn">Gửi ngay</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__con_map">
                            {!! @$settings->map !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#contact-form").on("submit", function(e) {
            e.preventDefault();

            let data = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "{{ route('handle-contact-form') }}",
                data: data,
                beforeSend: function() {
                    $("#contact-btn").text("Đang gửi...")
                    $("#contact-btn").attr("disabled", true)
                },
                success: function(data) {
                    if (data.status == "success") {
                        toastr.success(data.message)
                        $("#contact-btn").text("Đã Gửi")
                        $("#contact-btn").attr("disabled", false)
                    }
                    if (data.status == "error") {
                        toastr.error(data.message)
                        $("#contact-btn").text("Đăng Ký")
                        $("#contact-btn").attr("disabled", false)
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    console.log(errors);
                    if (errors) {
                        $.each(errors, function(key, value) {
                            toastr.error(value[0])
                        })
                    }
                    $("#contact-btn").text("Đăng Ký")
                    $("#contact-btn").attr("disabled", false)
                }
            })
        })
    </script>
@endpush
