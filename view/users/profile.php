
<div class="container mt-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-4">Cập nhật thông tin cá nhân</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form action="/profile" method="POST" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <?php if (!empty($user['image'])): ?>
                    <img src="<?php echo $user['image']; ?>" alt="Profile Image" class="rounded-circle" width="120" height="120">
                <?php endif; ?>
                <input type="file" style="width: 90px; height: 30px; margin-left: 130px; " class="form-control mt-2" name="image">
            </div>

            <div class="mb-3">
                <label class="form-label">Tên:</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu mới:</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới nếu muốn thay đổi">
            </div>

            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu:</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            </div>

            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
</div>


