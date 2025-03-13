<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2'; // Import SweetAlert2

const email = ref('');
const password = ref('');
const router = useRouter();
const API_URL = 'http://127.0.0.1:8000';

const login = async () => {
  try {
    const response = await axios.post(`${API_URL}/login`, {
      email: email.value,
      password: password.value,
    });

    const { user, token } = response.data;

    if (user && token) {
      // Store token and user details in localStorage
      localStorage.setItem('auth_token', token);
      localStorage.setItem('user', JSON.stringify(user));
      localStorage.setItem('role', user.role);

      // Set Axios default Authorization header
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      // Hiển thị thông báo thành công
      await Swal.fire({
        title: 'Đăng nhập thành công!',
        text: `Xin chào, ${user.name}!`,
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#69BA31',
      });

      // Redirect user based on role
      if (user.role === 'admin') {
        router.push('/admin/Dashboard');
      } else {
        router.push('/');
      }
    }
  } catch (error) {
    console.error('Đăng nhập thất bại:', error);

    let message = 'Không thể kết nối tới máy chủ';
    if (error.response) {
      message = error.response.data.message || 'Đăng nhập thất bại';
    }

    // Hiển thị thông báo lỗi
    Swal.fire({
      title: 'Lỗi!',
      text: message,
      icon: 'error',
      confirmButtonText: 'Thử lại',
      confirmButtonColor: '#d33',
    });
  }
};
</script>


<template>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
      style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" v-model="email" class="form-control" id="email" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" v-model="password" class="form-control" id="password" required />
        </div>
        <router-link to="/register" class="d-block mb-3">Bạn chưa có tài khoản? Đăng ký ngay</router-link>
        <router-link to="/forgotPassword" class="d-block mb-3">Quên mật khẩu</router-link>
        <button type="submit" class="btn btn-primary w-100">
          Đăng nhập
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 400px;
  margin: auto;
  padding-top: 50px;
}
</style>
