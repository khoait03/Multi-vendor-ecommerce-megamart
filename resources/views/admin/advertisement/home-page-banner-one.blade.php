<div class="tab-pane fade show active" id="list-home-ad-1" role="tabpanel" aria-labelledby="list-home-ad-1-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.advertisement.home-page-banner-one') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Trạng thái:</label>
                    <br>
                    <label class='custom-switch mt-2'>
                        <input type='checkbox' {{ @$homePageBannerOne->banner_one->status == 1 ? 'checked' : '' }}
                            name='status' class='custom-switch-input change-status'>
                        <span class='custom-switch-indicator'></span>
                    </label>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <br>
                    <img src="{{ asset(@$homePageBannerOne->banner_one->banner_image) }}" alt="" width="200px">
                    <input type="file" class="form-control mt-3" name="banner_image">
                    @if ($errors->has('banner_image'))
                        <p class="text-danger">{{ $errors->first('banner_image') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Đường dẫn khi nhấn nút</label>
                    <input type="text" class="form-control" name="banner_url" placeholder=""
                        value="{{ old('banner_url', @$homePageBannerOne->banner_one->banner_url) }}">
                    @if ($errors->has('banner_url'))
                        <p class="text-danger">{{ $errors->first('banner_url') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
