@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Khuyến Mãi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Khuyến Mãi</a></div>
                <div class="breadcrumb-item"><a href="#">Flash Sale</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Flash Sale</h2>
            <p class="section-lead">Tuỳ chỉnh Flash Sale hiển thị trên trang chủ.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thời gian kết thúc Flash Sale</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <h6 class="p-3 rounded bg-warning text-white w-25">Thời gian đã thiết lập:
                                        {{ $flashSale->end_date }}
                                    </h6>
                                    <label for="">Thiết lập thời gian</label>
                                    <input type="text" name="end_date" class="form-control datepicker"
                                        value="{{ old('end_date') }}">
                                    @if ($errors->has('end_date'))
                                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm sản phẩm vào Flash Sale</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="">Chọn sản phẩm</label>
                                    <select class="form-control select2" name="product" id="">
                                        <option value="">-- Chọn --</option>

                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('product'))
                                        <p class="text-danger">{{ $errors->first('product') }}</p>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Sản phẩm sẽ hiển thị trên trang chủ ?</label>
                                            <select class="form-control" name="show_at_home" id="">
                                                <option value="">-- Chọn --</option>
                                                <option value="1">Có</option>
                                                <option value="0">Không</option>
                                            </select>
                                            @if ($errors->has('show_at_home'))
                                                <p class="text-danger">{{ $errors->first('show_at_home') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Trạng thái</label>
                                            <select class="form-control" name="status" id="">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách sản phẩm của Flash Sale</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table(['class' => 'table nowrap', 'style' => 'width: 100%;']) }}</div>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left">STT</th>
                                            <th style="text-align: left">Id</th>
                                            {{-- <th style="text-align: left">ProductId</th> --}}
                                            <th style="text-align: left">Ảnh sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hiển thị tại trang chủ</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flashSaleItems as $key => $item)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $item->id }}</td>
                                                {{-- <td style="text-align: left">{{ $item->product->id }}</td> --}}
                                                <td style="text-align: left">
                                                    <img src="{{ asset($item->product->thumb_image) }}" alt=""
                                                        width="80" height="80">
                                                </td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>
                                                    @if ($item->show_at_home == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $item->id }}'
                                                                class='custom-switch-input change-show-at-home'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $item->id }}'
                                                                class='custom-switch-input change-show-at-home'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $item->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $item->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.flash-sale.destroy', $item->id) }}"
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
            $("body").on('click', ".change-show-at-home", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.flash-sale.show-at-home.change-status') }}",
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

            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.flash-sale.change-status') }}",
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

    <script>
        $(function() {
            $('input[name="end_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
        });
    </script>
@endpush
