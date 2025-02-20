@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Địa chỉ
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('user.address.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="fal fa-map"></i>Tạo địa chỉ mới</h3>
                <div class="wsus__dashboard_add wsus__add_address">
                    <form action="{{ route('user.address.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2 fw-bold h6">Họ và tên <b>*</b></label>
                                    <input class="form-control" type="text" name="name" placeholder="Nguyễn Văn A"
                                        value="{{ old('name') }}">
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
                                    <input class="form-control" type="text" name="phone" placeholder="0123456789"
                                        value="{{ old('phone') }}">
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

                                    <select class="form-select" id="quan" name="district_name" title="Chọn Quận Huyện">
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
@endpush
