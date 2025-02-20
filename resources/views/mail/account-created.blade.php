<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    Xin chào {{ $name }},
    Chào mừng bạn đến với hệ thống của chúng tôi.
    <br>
    Bạn đã được tạo một tài khoản với vai trò:
    {{ $role == 'user' ? 'Khách hàng' : ($role == 'vendor' ? 'Gian hàng' : 'Quản trị viên') }}.
    <br>

    Dưới đây là thông tin tài khoản:
    <br>
    Email đăng nhập: {{ $email }}
    <br>
    Mật khẩu đăng nhập: {{ $password }}
    <br>

    Lưu ý: Vui lòng đổi mật khẩu mặc định sau khi đăng nhập vào hệ thống.
    <br>

    Chúc bạn một ngày tốt lành!
</body>

</html>
