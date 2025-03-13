<script setup>
  import { ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const role = ref('user');
const API_URL = 'http://127.0.0.1:8000';

const register = async () => {
  // Kiểm tra các trường đầu vào
  if (
    name.value !== '' &&
    email.value !== '' &&
    password.value !== '' &&
    password_confirmation.value !== '' &&
    password.value === password_confirmation.value
  ) {
    const data = {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
      role: role.value
    };

    try {
      // Gửi yêu cầu POST để đăng ký
      const response = await axios.post(`${API_URL}/users`, data);
      if (response.status === 201) {
        // Hiển thị thông báo đăng ký thành công
        Swal.fire({
          title: 'Đăng ký thành công!',
          text: 'Bạn đã tạo tài khoản thành công.',
          icon: 'success',
          confirmButtonText: 'Đăng nhập ngay'
        }).then(() => {
          // Sau khi hiển thị thông báo, điều hướng về trang đăng nhập
          window.location.href = '/login';
        });
      }
    } catch (error) {
      console.error('Đăng ký thất bại:', error);
      // Hiển thị thông báo lỗi nếu có
      if (error.response) {
        Swal.fire({
          title: 'Lỗi!',
          text: error.response.data.message || 'Có lỗi xảy ra trong quá trình đăng ký',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      } else {
        Swal.fire({
          title: 'Lỗi!',
          text: 'Không thể kết nối tới máy chủ',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }
  } else {
    Swal.fire({
      title: 'Lỗi!',
      text: 'Mật khẩu và xác nhận mật khẩu không khớp',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
  }
};

</script>

<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card p-4" style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
        <form @submit.prevent="register">
        <div class="mb-3">
          <label for="name" class="form-label">Tên</label>
          <input type="text" v-model="name" class="form-control" id="name" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" v-model="email" class="form-control" id="email" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" v-model="password" class="form-control" id="password" required />
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
          <input type="password" v-model="password_confirmation" class="form-control" id="password_confirmation" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
      </form>
      </div>
    </div>
</template>

<style scoped>
.container {
  max-width: 500px;
  margin: auto;
}
</style>
