
<h1>Create Product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>

<!-- Thêm SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Xử lý gửi form và hiển thị thông báo thành công hoặc lỗi bằng SweetAlert2
    document.getElementById('createProductForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('create_product_backend.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Thành Công!',
                    text: 'Sản phẩm đã được tạo thành công.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Lỗi!',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Thử lại'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Lỗi!',
                text: 'Đã có lỗi xảy ra, vui lòng thử lại sau.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>