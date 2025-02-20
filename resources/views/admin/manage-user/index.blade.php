@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Người Dùng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Người Dùng</a></div>
                <div class="breadcrumb-item"><a href="#">Tài Khoản</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tài Khoản</h2>
            <p class="section-lead">Quản lý danh sách tài khoản trong hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm tài khoản</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.manage-user.create') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Tên người dùng</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ví dụ: Nguyễn Văn A" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Ví dụ: example@gmail.com" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mật khẩu</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="********" value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="********" value="{{ old('password_confirmation') }}">
                                            @if ($errors->has('password_confirmation'))
                                                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Vai trò</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="">- - Chọn - -</option>
                                        <option value="user">Khách hàng</option>
                                        <option value="vendor">Gian hàng</option>
                                        {{-- <option value="admin">Quản trị viên</option> --}}
                                    </select>
                                    @if ($errors->has('role'))
                                        <p class="text-danger">{{ $errors->first('role') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách tài khoản</h4>
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
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: left">Ảnh đại diện</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email khách hàng</th>
                                            <th style="text-align: left">Điện thoại khách hàng</th>
                                            <th style="text-align: left">Vai trò</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $user->id }}</td>
                                                <td style="text-align: left">
                                                    <img src="{{ $user->image ? asset($user->image) : 'https://static.vecteezy.com/system/resources/previews/019/879/186/non_2x/user-icon-on-transparent-background-free-png.png' }}"
                                                        alt="" width="70px">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td style="text-align: left">{{ $user->phone }}</td>
                                                <td style="text-align: left">
                                                    @switch($user->role)
                                                        @case('admin')
                                                            Quản trị viên
                                                        @break

                                                        @case('vendor')
                                                            Gian hàng
                                                        @break

                                                        @default
                                                            Khách hàng
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if ($user->role !== 'admin')
                                                        @if ($user->status == 'active')
                                                            <label class='custom-switch mt-2'>
                                                                <input type='checkbox' checked name='custom-switch-checkbox'
                                                                    data-id='{{ $user->id }}'
                                                                    class='custom-switch-input change-status'>
                                                                <span class='custom-switch-indicator'></span>
                                                            </label>
                                                        @else
                                                            <label class='custom-switch mt-2'>
                                                                <input type='checkbox' name='custom-switch-checkbox'
                                                                    data-id='{{ $user->id }}'
                                                                    class='custom-switch-input change-status'>
                                                                <span class='custom-switch-indicator'></span>
                                                            </label>
                                                        @endif
                                                    @endif
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
                    url: "{{ route('admin.manage-user.change-status') }}",
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
