@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Website</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Website</a></div>
                <div class="breadcrumb-item"><a href="#">Cài Đặt Trang Chủ</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cài Đặt Danh Mục Sản Phẩm Hiển Thị Trên Trang Chủ</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active"
                                            id="list-popular-categories-list" data-toggle="list"
                                            href="#list-popular-categories" role="tab">Tuỳ chỉnh danh mục phổ biến trong
                                            tháng</a>
                                        <a class="list-group-item list-group-item-action" id="list-slider-section-one-list"
                                            data-toggle="list" href="#list-slider-section-one" role="tab">Danh mục sản
                                            phẩm 1</a>
                                        <a class="list-group-item list-group-item-action" id="list-slider-section-two-list"
                                            data-toggle="list" href="#list-slider-section-two" role="tab">Danh mục sản
                                            phẩm 2</a>
                                        <a class="list-group-item list-group-item-action" id="list-weekly-best-rated-list"
                                            data-toggle="list" href="#list-weekly-best-rated" role="tab">Tuỳ chỉnh danh
                                            mục được đánh giá
                                            cao trong tuần</a>
                                        <a class="list-group-item list-group-item-action" id="list-weekly-best-sell-list"
                                            data-toggle="list" href="#list-weekly-best-sell" role="tab">Tuỳ chỉnh danh
                                            mục bán chạy trong tuần</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.home-page-setting.sections.popular-category-section')

                                        @include('admin.home-page-setting.sections.product-slider-section-one')

                                        @include('admin.home-page-setting.sections.product-slider-section-two')

                                        @include('admin.home-page-setting.sections.weekly-best-rated')

                                        @include('admin.home-page-setting.sections.weekly-best-sell')
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
