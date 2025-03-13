<script setup>
import { ref } from 'vue';
import axios from 'axios';

const email = ref('');
const API_URL = 'http://127.0.0.1:8000';
const sendResetPasswordEmail = async () => {
  try {
    const response = await axios.post(`${API_URL}/forgot-password`, {
      email: email.value,
    });
    alert(response.data.message);
  } catch (error) {
    console.error(error.response || error); // Log chi tiết lỗi
    alert('Không thể gửi email, vui lòng kiểm tra lại.');
  }
};

</script>
<template>
  <div class="container">
    <h1>Quên mật khẩu</h1>
    <p>Nhập email của bạn và nhấn gửi để nhận hướng dẫn đặt lại mật khẩu.</p>
    <input
      v-model="email"
      type="email"
      placeholder="Nhập email của bạn"
      class="input-email"
    />
    <button @click="sendResetPasswordEmail" class="btn-submit">Gửi yêu cầu</button>
  </div>
</template>

<style scoped>
.container {
  max-width: 400px;
  margin: auto;
  margin-top: 180px;
  text-align: center;
  background-color: #f9f9f9;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
}

h1 {
  font-size: 24px;
  color: #333;
  margin-bottom: 10px;
}

p {
  font-size: 14px;
  color: #555;
  margin-bottom: 20px;
}

.input-email {
  width: calc(100% - 20px);
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ddd;
  border-radius: 4px;
  outline: none;
  margin-bottom: 15px;
}

.input-email:focus {
  border-color: #5b9bd5;
  box-shadow: 0 0 5px rgba(91, 155, 213, 0.5);
}

.btn-submit {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  color: white;
  background-color: #006fd7;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-submit:hover {
  background-color: #4a8ac9;
}
</style>
