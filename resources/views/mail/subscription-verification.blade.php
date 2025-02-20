<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <h4>Vui lòng nhấn vào đường link dưới đây để xác thực email của bạn</h4>
    <a href="{{ route('new-letter-email-verify', $subscriber->verified_token) }}">Nhấn vào đây</a>
</body>

</html>
