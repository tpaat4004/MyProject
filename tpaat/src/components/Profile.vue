<template>
    <div class="profile-container container mt-5">
        <h1 class="text-primary mb-4">Thông tin cá nhân</h1>
        <div v-if="isLoading" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-else class="card shadow-sm p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Họ và tên:</label>
                <input v-model="user.name" class="form-control" />
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email:</label>
                <input v-model="user.email" class="form-control" />
            </div>
            <button @click="updateProfile" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Swal from 'sweetalert2';

const user = ref({ name: "", email: "" });
const isLoading = ref(true);
const router = useRouter();

const loadUserData = async () => {
    try {
        const token = localStorage.getItem("auth_token");
        if (!token) {
            alert("Vui lòng đăng nhập lại.");
            router.push("/login");
            return;
        }

        const response = await axios.get("http://127.0.0.1:8000/users", {
            headers: { Authorization: `Bearer ${token}` },
        });

        user.value = response.data;
        isLoading.value = false;
    } catch (error) {
        console.error("Lỗi khi tải thông tin người dùng:", error);
        alert("Không thể tải thông tin người dùng. Vui lòng thử lại.");
        isLoading.value = false;
    }
};

const updateProfile = async () => {
    try {
        const token = localStorage.getItem("auth_token");
        if (!token) {
            alert("Vui lòng đăng nhập lại.");
            router.push("/login");
            return;
        }

        await axios.put(`http://127.0.0.1:8000/users/${user.value.id}`, {
            name: user.value.name,
            email: user.value.email,
        }, {
            headers: { Authorization: `Bearer ${token}` },
        });

        await Swal.fire({
        title: 'Cập nhật thông tin người dùng thành công!',
        text: `Thông tin đã được cập nhật!`,
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#69BA31',
      });
    } catch (error) {
        console.error("Lỗi khi cập nhật thông tin người dùng:", error);
        if (error.response?.status === 403) {
            alert("Bạn không có quyền cập nhật thông tin này.");
        } else {
            alert("Đã xảy ra lỗi. Vui lòng thử lại sau.");
        }
    }
};

onMounted(loadUserData);
</script>

<style scoped>
.profile-container {
    max-width: 600px;
    margin: auto;
}

.card {
    background-color: #fff;
    border-radius: 10px;
}
</style>
