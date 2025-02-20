<div class="tab-pane fade" id="list-home-ad-2" role="tabpanel" aria-labelledby="list-home-ad-2-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.advertisement.home-page-banner-two') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">Quảng cáo bên trái</h5>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <br>
                            <label class='custom-switch mt-2'>
                                <input type='checkbox'
                                    {{ @$homePageBannerTwo->banner_one->status == 1 ? 'checked' : '' }}
                                    name='banner_one_status' class='custom-switch-input change-status'>
                                <span class='custom-switch-indicator'></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <br>
                            <img src="{{ asset(@$homePageBannerTwo->banner_one->banner_image) }}" alt=""
                                width="200px">
                            <input type="file" class="form-control mt-3" name="banner_one_image">
                            @if ($errors->has('banner_one_image'))
                                <p class="text-danger">{{ $errors->first('banner_one_image') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn khi nhấn nút</label>
                            <input type="text" class="form-control" name="banner_one_url" placeholder=""
                                value="{{ old('banner_one_url', @$homePageBannerTwo->banner_one->banner_url) }}">
                            @if ($errors->has('banner_one_url'))
                                <p class="text-danger">{{ $errors->first('banner_one_url') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">Quảng cáo bên phải</h5>
                        <div class="form-group">
                            <label>Trạng thái:</label>
                            <br>
                            <label class='custom-switch mt-2'>
                                <input type='checkbox'
                                    {{ @$homePageBannerTwo->banner_two->status == 1 ? 'checked' : '' }}
                                    name='banner_two_status' class='custom-switch-input change-status'>
                                <span class='custom-switch-indicator'></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <br>
                            <img src="{{ asset(@$homePageBannerTwo->banner_two->banner_image) }}" alt=""
                                width="200px">
                            <input type="file" class="form-control mt-3" name="banner_two_image">
                            @if ($errors->has('banner_two_image'))
                                <p class="text-danger">{{ $errors->first('banner_two_image') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn khi nhấn nút</label>
                            <input type="text" class="form-control" name="banner_two_url" placeholder=""
                                value="{{ old('banner_two_url', @$homePageBannerTwo->banner_two->banner_url) }}">
                            @if ($errors->has('banner_two_url'))
                                <p class="text-danger">{{ $errors->first('banner_two_url') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
