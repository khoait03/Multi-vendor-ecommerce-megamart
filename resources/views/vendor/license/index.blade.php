<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gia Hạn License</title>
    <!-- Thêm liên kết đến Bootstrap 5 từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>
                <strong>Giấy phép sử dụng Framework đã hết hạn!</strong>
                <p>Giấy phép sử dụng đã hết hạn vào ngày <strong>{{ env('LICENSE_EXPIRY_DATE') }}</strong>.</p>
                <p>Vui lòng gia hạn Giấy phép sử dụng để tiếp tục sử dụng dịch vụ.</p>
                <a target="_blank" href="https://themeforest.net/" class="btn btn-success">Gia hạn ngay</a>
                <a target="_blank" href="https://zalo.me/0336216546" class="btn btn-primary">Liên hệ tư vấn</a>
            </div>
        </div>



        <div class="card mt-4">
            <div class="card-header">
                <strong>Hướng dẫn gia hạn</strong>
            </div>
            <div class="card-body">
                <p>Để gia hạn Giấy phép sử dụng, vui lòng làm theo các bước sau:</p>
                <ol>
                    <li>Đăng nhập vào tài khoản của bạn.</li>
                    <li>Truy cập trang gia hạn giấy phép sử dụng.</li>
                    <li>Chọn phương thức thanh toán và hoàn tất giao dịch.</li>
                </ol>
            </div>
        </div>


        <div class="alert alert-warning d-flex align-items-center mt-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>
                <strong>Trở về trang chủ nếu bạn gia hạn thành công</strong><br><br>

                <a href="{{ config('app.url') }}" class="btn btn-success">Về trang chủ</a>
            </div>
        </div>

    </div>

    <!-- Thêm Bootstrap 5 JS từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
