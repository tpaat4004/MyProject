<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ1QY2f1p0ZiIc3ox0vTFA9u1Q9g5lmA2FzI4Ch3VcKpDkV7QErTtQ8hjl9A" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Login</h2>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <p>Don't have an account? <a href="/register">Register here</a></p>
            </div>
            <div class="text-center mt-3">
                <p><a href="/forgot_password">Forgot your password?</a></p>
            </div>
            <a href='google/login' style="text-decoration: none">
            <div id="g_id_onload"
                data-client_id="284544138294-js7c7nrmu14e6a34dlmer48r384vcvh2.apps.googleusercontent.com"
                data-context="signin" data-ux_mode="redirect"
                data-login_uri="http://localhost:8000/google/login"
                data-auto_prompt="false">
            </div>

            <div style="width: 300px; margin-top: 20px; height: 30px; margin-left: 30px;" class="g_id_signin"
                data-type="standard" data-shape="pill" data-theme="outline" data-text="signin_with" data-size="medium"
                data-logo_alignment="left" data-width="200px">
            </div>
        </a>
        </div>
    </div>

    <!-- Thêm Bootstrap JS và Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybP3Rj7Yjf6a7lV6ZJ7BCsw2P0v6yXy0wW9gM7u30N4v47zoJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p4t2zIiWV9z9WgWqqrrc0eNSki/Mm9yZDd/+d6Xy6pdlI+V" crossorigin="anonymous"></script>
    <script src="https://accounts.google.com/gsi/client" async></script>

</body>

</html>