@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Giới thiệu
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Giới Thiệu</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Giới Thiệu</a></li>
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
                    <div class="card">
                        <div class="card-body">
                            {!! @$about->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
