<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const token = route.query.token || ''; // Lấy token từ URL
const password = ref('');
const confirmPassword = ref('');
const API_URL = 'http://127.0.0.1:8000';

const resetPassword = async () => {
  try {
    const response = await axios.post(`${API_URL}/reset-password`, {
      token,
      password: password.value,
      password_confirmation: confirmPassword.value,
    });
    alert(response.data.message);
    window.location.href = '/login';
  } catch (error) {
    alert(error.response?.data?.message || 'Có lỗi xảy ra, vui lòng thử lại.');
  }
};
</script>

<template>
  <h1>Đặt lại mật khẩu</h1>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
      style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
      <form @submit.prevent="resetPassword" v-if="token">
        <div class="mb-3">
          <p v-if="token"><b>Token:</b> {{ token }}</p>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu mới:</label>
          <input id="password" v-model="password" class="form-control" type="password" placeholder="Nhập mật khẩu mới" />
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Xác nhận mật khẩu:</label>
          <input id="confirmPassword" class="form-control" v-model="confirmPassword" type="password" placeholder="Xác nhận mật khẩu"/>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đặt lại mật khẩu</button>
      </form>
      <p v-else>Không có token hợp lệ.</p>
    </div>
  </div>
</template>

<style scoped>
.container {
  padding-bottom: 200px;
}
</style>

