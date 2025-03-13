<h1>Edit User</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <?php if (!empty($user['image'])): ?>
            <div class="mb-2">
                <img src="/<?= htmlspecialchars($user['image']) ?>" alt="User Image" width="100" height="100">
            </div>
        <?php endif; ?>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>
