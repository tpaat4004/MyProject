<style>
  :root {
    --header-bg: #343a40;
    --primary-btn: #dc3545;
    --primary-btn-hover: #bb2d3b;
    --text-light: #f8f9fa;
    --border-color: rgba(255, 255, 255, 0.1);
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
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
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
  <h1 class="mt-4 text-center">Danh sách sản phẩm</h1>

  <?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $_SESSION['success_message'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
  <?php endif; ?>

  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Quản lý sản phẩm</h5>
      <a href="/admin/products/create" class="btn btn-add">
        <i class="fas fa-plus me-1"></i> Thêm sản phẩm
      </a>
    </div>
    <div class="card-body">
      <div class="filter-container">
        <div class="search-group">
          <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm sản phẩm...">
            <button class="btn btn-outline-secondary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Hình ảnh</th>
              <th>Giá</th>
              <th>Danh mục</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($products)): ?>
              <?php foreach ($products as $product): ?>
                <tr>
                  <td><?= $product['id'] ?></td>
                  <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                  <td>
                    <?php if (!empty($product['images'])): ?>
                      <?php foreach ($product['images'] as $img): ?>
                        <img src="/uploads/<?= htmlspecialchars($img) ?>" width="50" style="margin: 2px;">
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </td>
                  <td><?= number_format($product['price']) ?> đ</td>
                  <td><?= $product['category_name'] ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="/admin/products/<?= $product['id'] ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                      <a href="/admin/products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                      <button onclick="confirmDelete(<?= $product['id'] ?>)" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">Không có sản phẩm</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <?php if (isset($total_pages) && $total_pages > 1): ?>
        <nav class="mt-3">
          <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
  function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
      window.location.href = '/admin/products/delete/' + id;
    }
  }
</script>