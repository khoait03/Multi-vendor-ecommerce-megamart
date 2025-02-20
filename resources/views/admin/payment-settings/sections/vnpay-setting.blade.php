<div class="tab-pane fade" id="list-vnpay" role="tabpanel" aria-labelledby="list-vnpay-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.vnpay-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Kích hoạt thanh toán VNPay</label>
                    <select class="form-control" name="status" id="">
                        <option {{ @$vnpaySetting->status == 1 ? 'selected' : '' }} value="1">Kích hoạt</option>
                        <option {{ @$vnpaySetting->status == 0 ? 'selected' : '' }} value="0">Không kích hoạt
                        </option>
                    </select>
                    @if ($errors->has('status'))
                        <p class="text-danger">{{ $errors->first('status') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Chế độ tài khoản VNPay</label>
                    <select class="form-control" name="mode" id="">
                        <option {{ @$vnpaySetting->mode == 1 ? 'selected' : '' }} value="1">Chế độ thử nghiệm
                            (Sandbox)</option>
                        <option {{ @$vnpaySetting->mode == 0 ? 'selected' : '' }} value="0">Chế độ thực tế (Live)
                        </option>
                    </select>
                    @if ($errors->has('mode'))
                        <p class="text-danger">{{ $errors->first('mode') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Mã Website (vnp_TmnCode)</label>
                    <input type="text" class="form-control" name="client_id" placeholder=""
                        value="{{ old('client_id', @$vnpaySetting->client_id) }}">
                    @if ($errors->has('client_id'))
                        <p class="text-danger">{{ $errors->first('client_id') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Secret Key / Chuỗi bí mật tạo checksum (vnp_HashSecret)</label>
                    <input type="text" class="form-control" name="secret_key" placeholder=""
                        value="{{ old('secret_key', @$vnpaySetting->secret_key) }}">
                    @if ($errors->has('secret_key'))
                        <p class="text-danger">{{ $errors->first('secret_key') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
