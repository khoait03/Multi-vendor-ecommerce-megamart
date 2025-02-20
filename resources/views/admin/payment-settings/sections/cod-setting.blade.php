<div class="tab-pane fade" id="list-cod" role="tabpanel" aria-labelledby="list-cod-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.cod-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Kích hoạt thanh toán khi nhận hàng (COD)</label>
                    <select class="form-control" name="status" id="">
                        <option {{ @$codSetting->status == 1 ? 'selected' : '' }} value="1">Kích hoạt</option>
                        <option {{ @$codSetting->status == 0 ? 'selected' : '' }} value="0">Không kích hoạt
                        </option>
                    </select>
                    @if ($errors->has('status'))
                        <p class="text-danger">{{ $errors->first('status') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
