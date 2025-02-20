@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Người Đăng Ký Nhận Tin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Người Đăng Ký Nhận Tin</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tất Cả Người Đăng Ký Nhận Tin Tức</h2>
            <p class="section-lead">Danh sách tất cả người đã đăng ký nhận tin tức với hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gửi tin tức đến tất cả người đăng ký</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subscribers-send-mail') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control">
                                    @if ($errors->has('title'))
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung</label>
                                    <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                                    @if ($errors->has('content'))
                                        <p class="text-danger">{{ $errors->first('content') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách tất cả người đăng ký</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th>Email</th>
                                            <th>Trạng thái xác thực</th>
                                            <th style="text-align: center">Ngày đăng ký</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers as $subscriberKey => $subscriber)
                                            <tr>
                                                <td class="text-center">{{ $subscriberKey + 1 }}</td>
                                                <td style="text-align: left">{{ $subscriber->id }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>{{ $subscriber->is_verified == 1 ? 'Đã xác thực' : 'Chưa xác thực' }}
                                                </td>
                                                <td style="text-align: center">{{ $subscriber->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
