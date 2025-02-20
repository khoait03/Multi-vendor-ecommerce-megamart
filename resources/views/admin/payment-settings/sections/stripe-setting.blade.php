<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Kích hoạt thanh toán Stripe</label>
                    <select class="form-control" name="status" id="">
                        <option {{ $stripeSetting->status == 1 ? 'selected' : '' }} value="1">Kích hoạt</option>
                        <option {{ $stripeSetting->status == 0 ? 'selected' : '' }} value="0">Không kích hoạt
                        </option>
                    </select>
                    @if ($errors->has('status'))
                        <p class="text-danger">{{ $errors->first('status') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Chế độ tài khoản Stripe</label>
                    <select class="form-control" name="mode" id="">
                        <option {{ $stripeSetting->mode == 1 ? 'selected' : '' }} value="1">Chế độ thử nghiệm
                            (Sandbox)</option>
                        <option {{ $stripeSetting->mode == 0 ? 'selected' : '' }} value="0">Chế độ thực tế (Live)
                        </option>
                    </select>
                    @if ($errors->has('mode'))
                        <p class="text-danger">{{ $errors->first('mode') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Quốc gia</label>
                    <input type="text" class="form-control" name="country_name" placeholder="Ví dụ: Việt Nam"
                        value="{{ old('country_name', $stripeSetting->country_name) }}">
                    @if ($errors->has('country_name'))
                        <p class="text-danger">{{ $errors->first('country_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Đơn vị tiền tệ</label>
                    <input type="text" class="form-control" name="currency_name" placeholder="Ví dụ: VND"
                        value="{{ old('currency_name', $stripeSetting->currency_name) }}">
                    @if ($errors->has('currency_name'))
                        <p class="text-danger">{{ $errors->first('currency_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tỉ giá chuyển đổi từ VND sang USD</label>
                    <input type="number" class="form-control" name="currency_rate" placeholder="Ví dụ: 23000"
                        value="{{ old('currency_rate', $stripeSetting->currency_rate) }}">
                    @if ($errors->has('currency_rate'))
                        <p class="text-danger">{{ $errors->first('currency_rate') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Stripe Client ID</label>
                    <input type="text" class="form-control" name="client_id" placeholder=""
                        value="{{ old('client_id', $stripeSetting->client_id) }}">
                    @if ($errors->has('client_id'))
                        <p class="text-danger">{{ $errors->first('client_id') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" placeholder=""
                        value="{{ old('secret_key', $stripeSetting->secret_key) }}">
                    @if ($errors->has('secret_key'))
                        <p class="text-danger">{{ $errors->first('secret_key') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
