<style setup></style>
<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="/">
          <img src="@/assets/images/logo-didongviet.png" alt="Logo" width="130" height="70" class="me-2" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <RouterLink to="/dtb" class="nav-link">Đtb</RouterLink>
            </li>
            <div class="nav-item">
              <RouterLink to="/cart" class="nav-link">Giỏ hàng</RouterLink>
            </div>
            <div class="nav-item">
              <RouterLink to="/Order" class="nav-link">Đơn hàng</RouterLink>
            </div>
            <li class="nav-item dropdown">
              <button v-if="isLoggedIn" class="btn btn-primary nav-link text-white px-3 dropdown-toggle" id="userMenu"
                data-bs-toggle="dropdown" aria-expanded="false">
                Tài khoản
              </button>
              <button v-else class="btn btn-primary nav-link text-white px-3" @click="goToLogin">
                Đăng nhập
              </button>
              <ul v-if="isLoggedIn" class="dropdown-menu" aria-labelledby="userMenu">
                <li>
                  <RouterLink to="/profile" class="dropdown-item">Thông tin tài khoản</RouterLink>
                </li>
                <li>
                  <button @click="logout" class="dropdown-item text-danger">Đăng xuất</button>
                </li>
              </ul>
            </li>

            <!-- <li class="nav-item">
              <button v-if="!isLoggedIn" @click="goToLogin" class="btn btn-primary nav-link text-white px-3">
                Login
              </button>
              <button v-else @click="logout" class="btn btn-danger nav-link text-white px-3">
                Logout
              </button>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>

    <!-- Nơi hiển thị nội dung -->
    <main class="container mt-4">
      <RouterView />
    </main>

    <!-- Nội dung trang -->
    <footer class="footer-container">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>Liên hệ</h5>
            <p>Địa chỉ: 123 Đường ABC, Thành phố XYZ</p>
            <p>Điện thoại: 0123 456 789</p>
            <p>Email: info@example.com</p>
          </div>
          <div class="col-md-4">
            <h5>Menu</h5>
            <ul class="list-unstyled">
              <li>
                <RouterLink to="/" class="footer-link">Trang chủ</RouterLink>
              </li>
              <li>
                <RouterLink to="/products" class="footer-link">Sản phẩm</RouterLink>
              </li>
              <li>
                <RouterLink to="/dtb" class="footer-link">Đtb</RouterLink>
              </li>
              <li>
                <RouterLink to="/user" class="footer-link">Tài khoản</RouterLink>
              </li>
            </ul>
          </div>
          <!-- Mạng xã hội -->
          <div class="col-md-4">
            <h5>Theo dõi chúng tôi</h5>
            <div class="social-icons">
              <a href="https://facebook.com" target="_blank" class="social-link">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://twitter.com" target="_blank" class="social-link">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://instagram.com" target="_blank" class="social-link">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://youtube.com" target="_blank" class="social-link">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="text-center">
          <p>© 2024 Your Company. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>

import Swal from 'sweetalert2';

export default {
  data() {
    return {
      isLoggedIn: false, // Trạng thái đăng nhập
    };
  },
  mounted() {
    // Kiểm tra trạng thái đăng nhập khi component được gắn
    this.checkLoginStatus();
  },
  methods: {
    checkLoginStatus() {
      // Kiểm tra nếu có thông tin người dùng trong localStorage
      const user = JSON.parse(localStorage.getItem('user'));
      this.isLoggedIn = !!user; // Đặt isLoggedIn thành true nếu có user
    },
    goToLogin() {
      // Điều hướng đến trang đăng nhập
      this.$router.push('/login');
    },
    async logout() {
      // Hiển thị thông báo xác nhận trước khi đăng xuất
      const result = await Swal.fire({
        title: 'Bạn có chắc chắn muốn đăng xuất?',
        text: 'Tài khoản của bạn sẽ bị đăng xuất.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Hủy',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
      });

      if (result.isConfirmed) {
        // Xóa thông tin đăng nhập và điều hướng về trang login
        localStorage.clear();
        this.isLoggedIn = false;
        await Swal.fire({
          title: 'Đăng xuất thành công!',
          text: 'Hẹn gặp lại bạn.',
          icon: 'success',
          confirmButtonText: 'OK',
          confirmButtonColor: '#69BA31',
        });
        this.$router.push('/login');
      }
    },
  },
};

</script>


<style scoped>
@import '@/assets/css/main.css';
/* Đường dẫn tương đối tới footer.css */
</style>