<template>
  <div class="admin-layout">
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Admin Panel</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <RouterLink to="/admin/orders" class="nav-link">Orders</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink to="/admin/settings" class="nav-link">Settings</RouterLink>
            </li>
            <li class="nav-item">
              <button @click="logout" class="btn btn-danger btn-sm">
                Đăng xuất
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Sidebar and Content -->
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-light p-0 sidebar">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <RouterLink to="/admin/Dashboard" class="nav-link">Dashboard</RouterLink>
            </li>
            <li class="list-group-item">
              <RouterLink to="/admin/categoryList" class="nav-link">Categories</RouterLink>
            </li>
            <li class="list-group-item">
              <RouterLink to="/admin/productsList" class="nav-link">Products</RouterLink>
            </li>
            <li class="list-group-item">
              <RouterLink to="/admin/ordersList" class="nav-link">Orders</RouterLink>
            </li>
            <li class="list-group-item">
              <RouterLink to="/admin/reports" class="nav-link">Reports</RouterLink>
            </li>
          </ul>
        </div>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 ms-sm-auto px-4">
          <RouterView />
        </main>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Custom Styles */
.admin-layout {
  font-family: 'Arial', sans-serif;
}

/* Sidebar Styling */
.sidebar {
  min-height: 100vh;
  border-right: 1px solid #ddd;
}
.sidebar .nav-link {
  color: #333;
  padding: 10px 15px;
  font-weight: 500;
  text-decoration: none;
}
.sidebar .nav-link:hover {
  background-color: #f8f9fa;
  color: #0056b3;
}

/* Navbar */
.navbar-brand {
  font-size: 1.5rem;
}
.nav-link {
  font-size: 1rem;
}
</style>
<script>
import Swal from 'sweetalert2';

export default {
  methods: {
    logout() {
      // Hiển thị hộp thoại xác nhận
      Swal.fire({
        title: 'Admin có chắc chắn muốn đăng xuất?',
        text: 'Hành động này sẽ kết thúc phiên làm việc hiện tại của bạn.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Hủy',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
      }).then((result) => {
        if (result.isConfirmed) {
          // Xóa dữ liệu người dùng khỏi localStorage
          localStorage.clear();
          // Hiển thị thông báo thành công
          Swal.fire({
            title: 'Đăng xuất thành công!',
            text: 'Hẹn gặp lại Admin.',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
          }).then(() => {
            // Điều hướng về trang đăng nhập
            this.$router.push({ name: 'login' });
          });
        }
      });
    },
  },
};
</script>