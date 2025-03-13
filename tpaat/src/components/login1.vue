<script setup>
import { ref } from 'vue';

const status = ref("không hoạt động");
const changeStatus = () => {
    const dataStatus = prompt("Cập nhật trạng thái hoạt động:");
    if (dataStatus) {
        status.value = dataStatus;
    }
};

const img = ref("https://png.pngtree.com/png-clipart/20210608/ourlarge/pngtree-dark-gray-simple-avatar-png-image_3418404.jpg");
const changeImg = () => {
    const dataImg = prompt("Nhập URL hình ảnh mới:");
    if (dataImg) {
        img.value = dataImg;
    }
};

const username = ref('');
const password = ref('');
const submitLogin = () => {
    if (username.value === 'admin' && password.value === '123456') {
        alert('Đăng nhập thành công');
    } else {
        alert('Sai thông tin đăng nhập');
    }
};
</script>

<template>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
      <div class="text-center mb-3">
          <img @click="changeImg" class="rounded-circle" :src="img" alt="Avatar" width="100" height="100">
      </div>

      <h3 class="text-center">Đăng nhập</h3>
      <p class="text-center text-muted mb-3">{{ status }}</p>
      <button @click="changeStatus" class="btn btn-outline-secondary w-100 mb-3">Cập nhật trạng thái</button>
      
      <form @submit.prevent="submitLogin">
        <div class="form-group mb-3">
          <input type="text" class="form-control" placeholder="Tên đăng nhập của bạn" v-model="username" required>
        </div>
        
        <div class="form-group mb-3">
          <input type="password" class="form-control" placeholder="Nhập mật khẩu" v-model="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 mb-3">Đăng nhập</button>

        <div class="d-flex justify-content-between">
          <a href="forgotpassword.html" class="text-danger">Quên mật khẩu?</a>
          <a href="register.html" class="text-primary">Đăng ký</a>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
.container {
  height: 100vh;
  margin-left: 250px;
}

.card {
  background-color: #ffffff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.btn-outline-primary {
  color: #007bff;
  border-color: #007bff;
}

.form-control {
  border-radius: 5px;
  padding: 10px;
}

a {
  font-size: 14px;
}
</style>
