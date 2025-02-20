@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Website</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Website</a></div>
                <div class="breadcrumb-item"><a href="#">Slider</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Slider</h2>
            <p class="section-lead">Tuỳ chỉnh slider hiển thị trên trang chủ.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách slider</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            {{ $dataTable->table(['class' => 'table nowrap table-responsive', 'style' => 'width: 100%;']) }}
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: left">Hình ảnh</th>
                                            <th>Thể loại</th>
                                            <th>Tiêu đề</th>
                                            <th>Giá khởi điểm</th>
                                            <th>Đường link khi nhấn nút</th>
                                            <th style="text-align: left">Thứ tự</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $key => $slider)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $slider->id }}</td>
                                                <td style="text-align: left">
                                                    <img src=" {{ asset($slider->banner) }}" width="150px">
                                                </td>
                                                <td>{{ $slider->type }}</td>
                                                <td>{{ $slider->title }}</td>
                                                <td>{{ formatMoney($slider->starting_price) }}</td>
                                                <td>{{ $slider->btn_url }}</td>
                                                <td style="text-align: left">{{ $slider->serial }}</td>
                                                <td>
                                                    @if ($slider->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $slider->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $slider->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.slider.destroy', $slider->id) }}"
                                                            class='btn btn-danger mr-2 delete-item'>
                                                            <i class='fas fa-trash'></i>
                                                        </a>
                                                    </div>
                                                </td>
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

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.slider.change-status') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        status: isChecked
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
