<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
