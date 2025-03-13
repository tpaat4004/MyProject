<template>
    <div class="container py-5">
        <div class="row">
            <!-- Form thêm danh mục sản phẩm -->
            <div class="col-md-4">
                <h5>{{ editingId ? 'Sửa sản phẩm' : 'Thêm sản phẩm' }}</h5>
                <form @submit.prevent="addOrUpdateProduct">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Danh mục</label>
                        <select v-model="category_id" class="form-control" required>
                            <option value="" disabled selected>Chọn danh mục</option>

                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm</label>
                        <input type="text" id="productName" v-model="name" class="form-control"
                            placeholder="Nhập tên sản phẩm" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Miêu tả</label>
                        <input type="text" id="description" v-model="description" class="form-control"
                            placeholder="Nhập miêu tả sản phẩm" />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" id="image" @change="handleImageUpload" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" id="price" v-model="price" class="form-control"
                            placeholder="Nhập giá sản phẩm" required />
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" id="quantity" v-model="quantity" class="form-control"
                            placeholder="Nhập số lượng sản phẩm" required />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editingId ? 'Cập nhật' : 'Thêm' }}</button>
                    <button type="button" class="btn btn-danger" v-if="editingId" @click="resetForm">Hủy</button>
                </form>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="col-md-8">
                <h2>Danh sách sản phẩm</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID danh mục</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Miêu tả</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody v-for="(item, index) in products" :key="item.id || index">
                        <tr>
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.category_id }}</td>
                            <div class="image-container">
                                <img v-if="item.image" :src="item.image" alt="Product Image" />
                            </div>

                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.quantity }}</td>
                            <button @click="deleteProduct(item.id)" class="btn btn-danger">Xóa</button>
                            <button @click="editProduct(item)" class="btn btn-primary">Sửa</button>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const products = ref([]);
const categories = ref([]);
const name = ref('');
const description = ref('');
const image = ref(null); // Thay đổi từ string thành file
const price = ref('');
const quantity = ref('');
const category_id = ref(null);
const editingId = ref(null);
const API_URL = 'http://127.0.0.1:8000';

onMounted(async () => {
    try {
        const response = await axios.get(`${API_URL}/products`);
        if (response.status === 200) {
            products.value = response.data;
        }
        const categoryResponse = await axios.get(`${API_URL}/categories`);
        if (categoryResponse.status === 200) {
            categories.value = categoryResponse.data;
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});



const reload = async () => {
    try {
        const response = await axios.get(`${API_URL}/products`);
        if (response.status === 200) {
            products.value = response.data;
        }
    } catch (error) {
        console.error('Error reloading products:', error);
        alert('Không thể tải lại danh sách sản phẩm');
    }
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        image.value = file;  // Gán file ảnh vào biến
    }
};

const addOrUpdateProduct = async () => {
    const formData = new FormData();
    formData.append('category_id', category_id.value);
    formData.append('name', name.value);
    if (image.value) {
        formData.append('image', image.value); // Chỉ thêm nếu có file ảnh
    }
    formData.append('description', description.value || '');
    formData.append('price', price.value);
    formData.append('quantity', quantity.value);

    try {
        let response;
        if (editingId.value) {
            // Update sản phẩm
            response = await axios.post(
                `${API_URL}/products/${editingId.value}?_method=PUT`,
                formData,
                { headers: { 'Content-Type': 'multipart/form-data' } }
            );
        } else {
            // Thêm mới sản phẩm
            response = await axios.post(
                `${API_URL}/products`,
                formData,
                { headers: { 'Content-Type': 'multipart/form-data' } }
            );
        }

        if (response.status === 200 || response.status === 201) {
            Swal.fire({
                icon: 'success',
                title: editingId.value ? 'Cập nhật thành công' : 'Thêm mới thành công',
                text: editingId.value ? 'Sản phẩm đã được cập nhật' : 'Sản phẩm đã được thêm',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
            reload();
            resetForm();
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm hoặc cập nhật sản phẩm');
    }
};
const deleteProduct = async (id) => {
    try {
        const response = await axios.delete(`${API_URL}/products/${id}`);
        if (response.status === 200) {
            Swal.fire({
                icon: 'success',
                title: 'Xóa sản phẩm thành công!',
                text: 'Sản phẩm đã được xóa.',
                confirmButtonColor: '#69BA31',
            });
            reload();
        }
    } catch (error) {
        console.error('Error deleting product:', error);
        alert('Không thể xóa sản phẩm');
    }
};

const editProduct = (item) => {
    name.value = item.name;
    description.value = item.description;
    price.value = item.price;
    quantity.value = item.quantity;
    category_id.value = item.category_id;
    editingId.value = item.id;
};

const resetForm = () => {
    name.value = '';
    description.value = '';
    image.value = null;
    price.value = '';
    quantity.value = '';
    category_id.value = null;
    editingId.value = null;
};
</script>
<style>
.image-container {
    width: 80px;
    height: 80px;
    justify-content: center;
    align-items: center;
    border: 1px solid #ddd;
    /* Tùy chọn: Thêm viền để ảnh nổi bật */
    border-radius: 4px;
    /* Tùy chọn: Thêm bo góc nếu cần */
}

.image-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    /* Đảm bảo giữ tỷ lệ và không bị cắt */
}
</style>
