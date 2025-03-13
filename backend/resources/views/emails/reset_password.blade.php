<!DOCTYPE html>
<html>
<head>
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <p>Xin chào,</p>
    <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào liên kết bên dưới để đặt lại mật khẩu của bạn:</p>
    <a href="{{ url('http://localhost:5173') }}/reset-password?token={{ $token }}">Đặt lại mật khẩu</a>
    <p>Liên kết này sẽ hết hạn sau 30 phút.</p>
    <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>
    <p>Trân trọng,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
