@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Địa chỉ
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content">
                <h3><i class="fal fa-map"></i> Địa chỉ</h3>
                <div class="wsus__dashboard_add">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i
                                    class="far fa-plus"></i>
                                Thêm địa chỉ</a>
                        </div>

                        @foreach ($addresses as $key => $address)
                            <div class="col-xl-6">
                                <div class="wsus__dash_add_single">
                                    <h4><strong>Địa chỉ {{ $key + 1 }}</strong></h4>
                                    <ul>
                                        <li><span><strong>Họ và tên :</strong></span> {{ $address->name }}</li>
                                        <li><span><strong>Điện thoại :</strong></span> {{ $address->phone }}</li>
                                        <li><span><strong>Email :</strong></span> {{ $address->email }}</li>
                                        <li><span><strong>Tỉnh/Thành Phố :</strong></span> {{ $address->province_city }}
                                        </li>
                                        <li><span><strong>Quận/Huyện :</strong></span> {{ $address->district }}</li>
                                        <li><span><strong>Xã/Phường :</strong></span> {{ $address->commune_ward }}</li>
                                        <li><span><strong>Số nhà, căn hộ :</strong></span> {{ $address->address }}</li>
                                        <li><span><strong>Yêu cầu khác :</strong></span> {{ $address->other }}</li>
                                    </ul>
                                    <div class="wsus__address_btn">
                                        <a href="{{ route('user.address.edit', $address->id) }}" class="edit"><i
                                                class="fal fa-edit"></i>
                                            Chỉnh sửa</a>
                                        <a href="{{ route('user.address.destroy', $address->id) }}"
                                            class="bg-danger delete-item"><i class="fal fa-trash-alt"></i> Xoá</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
