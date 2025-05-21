<style>
:root {
    --header-bg: #343a40;
    --primary-btn: #dc3545;
    --primary-btn-hover: #bb2d3b;
    --text-light: #f8f9fa;
    --border-color: rgba(255,255,255,0.1);
}

/* Update text center color */
h1.text-center {
    color: var(--header-bg) !important;
}

.mt-4 {
    color: var(--header-bg);
}

/* Filter styles */
.filter-container {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.search-group {
    flex: 2;
    min-width: 300px;
}

/* Card and button styles */
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
}

.card-header {
    background: var(--header-bg) !important;
    border-bottom: 1px solid var(--border-color);
}

.btn-add {
    background-color: var(--primary-btn);
    border-color: var(--primary-btn);
    color: var(--text-light);
}

.btn-add:hover {
    background-color: var(--primary-btn-hover);
    border-color: var(--primary-btn-hover);
    color: var(--text-light);
}

/* Table styles */
.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
}

.badge {
    font-size: 85%;
}

.badge.bg-info {
    background-color: var(--header-bg) !important;
}

@media (max-width: 768px) {
    .filter-container {
        flex-direction: column;
        gap: 1rem;
    }

    .filter-group,
    .search-group {
        width: 100%;
        min-width: 100%;
    }

    .input-group {
        margin-bottom: 0;
    }

    .btn-group {
        flex-wrap: nowrap;
        gap: 0.5rem;
    }
    
    .btn-group .btn {
        flex: 1;
    }
}
</style>
<div class="container-fluid px-4">
  <h1 class="mt-4 text-center">Chỉnh sửa sản phẩm</h1>

  <?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($_SESSION['errors'] as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; unset($_SESSION['errors']); ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Thông tin sản phẩm</h5>
    </div>
    <div class="card-body">
      <form action="/admin/products/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Hình ảnh hiện tại</label><br>
          <?php if (!empty($product['images'])): ?>
                      <?php foreach ($product['images'] as $img): ?>
                        <img src="/uploads/<?= htmlspecialchars($img) ?>" width="50" style="margin: 2px;">
                      <?php endforeach; ?>
                    <?php endif; ?>
          <input type="file" name="images[]" multiple accept="image/*">
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Giá</label>
          <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
          <label for="category" class="form-label">Danh mục</label>
          <select class="form-select" id="category" name="category_id" required>
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Mô tả</label>
          <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="d-flex justify-content-between">
          <a href="/admin/products" class="btn btn-secondary">Quay lại</a>
          <button type="submit" class="btn btn-add">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
