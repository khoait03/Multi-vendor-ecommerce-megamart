<div class="tab-pane fade" id="list-email-setting" role="tabpanel" aria-labelledby="list-email-setting-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.email-setting-update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder=""
                        value="{{ old('email', $emailSetting->email) }}">
                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Mail Host</label>
                    <input type="text" class="form-control" name="host" placeholder=""
                        value="{{ old('host', $emailSetting->host) }}">
                    @if ($errors->has('host'))
                        <p class="text-danger">{{ $errors->first('host') }}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Smtp Username</label>
                            <input type="text" class="form-control" name="username" placeholder=""
                                value="{{ old('username', $emailSetting->username) }}">
                            @if ($errors->has('username'))
                                <p class="text-danger">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Smtp password</label>
                            <input type="password" class="form-control" name="password" placeholder=""
                                value="{{ old('password', $emailSetting->password) }}">
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail port</label>
                            <input type="text" class="form-control" name="port" placeholder=""
                                value="{{ old('port', $emailSetting->port) }}">
                            @if ($errors->has('port'))
                                <p class="text-danger">{{ $errors->first('port') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email Encryption</label>
                            <select name="encryption" id="" class="form-control">
                                <option {{ $emailSetting->encryption == 'tls' ? 'selected' : '' }} value="tls">TLS
                                </option>
                                <option {{ $emailSetting->encryption == 'ssl' ? 'selected' : '' }} value="ssl">SSL
                                </option>
                            </select>
                            @if ($errors->has('encryption'))
                                <p class="text-danger">{{ $errors->first('encryption') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
