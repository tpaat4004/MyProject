<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from "sweetalert2";

const categories = ref([]);
const name = ref('');
const editingId = ref(null);
const API_URL = 'http://127.0.0.1:8000';

onMounted(async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/categories');
        if (response.status === 200) {
            console.log(response.data);
            categories.value = response.data;
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});

// const addCategory = async () => {
//     if (name.value !== '') {
//         const data = {
//             name: name.value
//         };
//         const reponse = await axios.post(`${API_URL}/categories`, data);
//         if (response.status === 201) {
//             alert('Thêm thành công')
//             console.log(response.data);
//             categories.value.push(response?.data?.data);
//             name.value ="";
//         }
//     }
// }

const reload = async () => {
    try {
        const response = await axios.get(`${API_URL}/categories`);
        if (response.status === 200) {
            categories.value = response.data;
        }
    } catch (error) {
        console.error('Error reloading products:', error);
        alert('Không thể tải lại danh sách sản phẩm');
    }
};

const addOrUpdateCategory = async () => {
    if (name.value.trim() !== '') {
        try {
            if (editingId.value) {
                // Nếu đang chỉnh sửa, gửi yêu cầu PUT để cập nhật danh mục
                const response = await axios.put(`${API_URL}/categories/${editingId.value}`, { name: name.value });
                if (response.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật danh mục thành công!',
                        text: 'Danh mục đã được cập nhật.',
                        confirmButtonColor: '#69BA31',
                    });
                    reload();
                    editingId.value = null; // Reset lại trạng thái sau khi cập nhật
                }
            } else {
                // Nếu không có ID đang chỉnh sửa, thêm danh mục mới
                const response = await axios.post(`${API_URL}/categories`, { name: name.value });
                if (response.status === 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm danh mục thành công!',
                        text: 'Danh mục đã được thêm.',
                        confirmButtonColor: '#69BA31',
                    });
                    categories.value.push(response.data);
                    reload();
                }
            }
            name.value = ''; // Reset ô nhập sau khi thêm hoặc cập nhật
        } catch (error) {
            console.error('Error adding/updating category:', error);
            alert('Không thể thêm hoặc cập nhật danh mục');
        }
    }
};


const deleteCategory = async (id) => {
    const response = await axios.delete(`${API_URL}/categories/${id}`);
    if (response.status === 200) {
        Swal.fire({
        icon: 'success',
        title: 'Xóa danh mục thành công!',
        text: 'Danh mục đã được xóa.',
        confirmButtonColor: '#69BA31',
      });
        reload();
    }
}
const editCategory = async (item) => {
    name.value = item.name;
    editingId.value = item.id;
}
</script>

<template>
    <div class="container py-5">
        <div class="row">
            <!-- Form thêm danh mục sản phẩm -->
            <div class="col-md-4">
                <h5>{{ editingId ? 'Sửa danh mục' : 'Thêm danh mục' }}</h5>
                <form @submit.prevent="addOrUpdateCategory">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Tên danh mục</label>
                        <input type="text" id="categoryName" v-model="name" class="form-control"
                            placeholder="Nhập tên danh mục" required />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editingId ? 'Cập nhật' : 'Thêm' }}</button>
                    <button type="submit" class="btn btn-danger" v-if="editingId">Hủy</button>
                </form>
            </div>

            <!-- Danh sách danh mục sản phẩm -->
            <div class="col-md-8">
                <h2>Danh sách danh mục sản phẩm</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên danh mục</th>
                        </tr>
                    </thead>
                    <tbody v-for="(item, index) in categories" :key="item.id || index">
                        <tr>
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.name }}</td>
                            <button @click="deleteCategory(item.id)" class="btn btn-danger">Xóa</button>
                            <button @click="editCategory(item)" class="btn btn-primary">Sửa</button>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


<style scoped>
.container {
    width: 1500px;
}
</style>