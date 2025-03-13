<script setup>
import { reactive, ref } from 'vue';
const user = reactive({
    name: '',
    age: null,
    email: ''
});
const errors = reactive({
    name: '',
    age: '',
    email: ''
});

const validate = () => {
      errors.name = user.name ? '' : 'Tên không được để trống.';
      errors.age = user.age && user.age > 0 ? '' : 'Tuổi phải là số dương.';
      errors.email = user.email.includes('@') ? '' : 'Email không hợp lệ.';

      return !errors.name && !errors.age && !errors.email;
    };
const updated = ref(false);

const updateUser = () => {
    if (validate()) {
        updated.value = true;
        alert('Cập nhật thành công');
    } return false
}
</script>
<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 400px; background-color: #f9f9f9; border-radius: 12px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);">
            <h4>Cập nhật thông tin người dùng</h4>
            <form @submit.prevent="updateUser">
                <div class="form-group mb-3">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input v-model="user.name" class="form-control" name="name" type="text">
                        <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                    </div>
                    <div class="form-group">
                        <label for="age">Tuổi:</label>
                        <input v-model="user.age" class="form-control" name="age" type="age">
                        <span v-if="errors.age" class="text-danger">{{ errors.age }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input v-model="user.email" class="form-control" name="email" type="email">
                        <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
.container {
    margin-left: 250px;
}
</style>