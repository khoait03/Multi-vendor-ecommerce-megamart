<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.general-setting-update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tên website</label>
                    <input type="text" class="form-control" name="site_name" placeholder=""
                        value="{{ old('site_name', @$generalSetting->site_name) }}">
                    @if ($errors->has('site_name'))
                        <p class="text-danger">{{ $errors->first('site_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email liên lạc</label>
                    <input type="email" class="form-control" name="contact_email" placeholder=""
                        value="{{ old('contact_email', @$generalSetting->contact_email) }}">
                    @if ($errors->has('contact_email'))
                        <p class="text-danger">{{ $errors->first('contact_email') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Điện thoại liên lạc</label>
                    <input type="text" class="form-control" name="contact_phone" placeholder=""
                        value="{{ old('contact_phone', @$generalSetting->contact_phone) }}">
                    @if ($errors->has('contact_phone'))
                        <p class="text-danger">{{ $errors->first('contact_phone') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" name="contact_address" placeholder=""
                        value="{{ old('contact_address', @$generalSetting->contact_address) }}">
                    @if ($errors->has('contact_address'))
                        <p class="text-danger">{{ $errors->first('contact_address') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Google Map (Dùng iframe)</label>
                    <textarea class="form-control" name="map" id="" cols="30" rows="20">{{ old('map', @$generalSetting->map) }}</textarea>
                    @if ($errors->has('map'))
                        <p class="text-danger">{{ $errors->first('map') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
