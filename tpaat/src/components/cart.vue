<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router'; // Thêm useRouter
import axios from 'axios';
import Swal from 'sweetalert2'; // Import SweetAlert2

const cart = ref([]);
const route = useRoute();
const router = useRouter(); // Khởi tạo router

// Lấy giỏ hàng từ API khi tải trang
onMounted(async () => {
    const token = localStorage.getItem('auth_token');  // Hoặc lấy từ cookie/session nếu dùng cookie

    axios.get('http://127.0.0.1:8000/cart', {
        headers: {
            Authorization: `Bearer ${token}`,
        }
    })
        .then(response => {
            cart.value = response.data;
        })
        .catch(error => {
            console.error('Lỗi khi lấy giỏ hàng:', error);
        });
});

// Định dạng giá tiền
const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

// Tính tổng tiền của giỏ hàng
const totalPrice = computed(() => {
    return cart.value.reduce((total, item) => total + item.product.price * item.quantity, 0);
});

// Cập nhật số lượng sản phẩm trong giỏ
const updateQuantity = async (item, quantity) => {
    if (quantity < 1) {
        removeFromCart(item.id); // Nếu số lượng nhỏ hơn 1, xóa sản phẩm khỏi giỏ
        return;
    }
    if (quantity > item.product.quantity) {
        Swal.fire({
            icon: 'warning',
            title: 'Số lượng không thể lớn hơn số lượng trong kho là ' + item.product.quantity + '!',
            text: 'Xin quý khách thông cảm!',
            buttonText: 'OK',
            confirmButtonColor: '#69BA31',
        }).then(() => {
            item.quantity = 1;
        });
        return;
    }

    try {
        // Gọi API cập nhật số lượng
        await axios.put(`http://127.0.0.1:8000/cart/${item.id}`, { quantity }, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
        });

        // Cập nhật số lượng trong giao diện
        item.quantity = quantity;

        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thành công!',
            text: `Số lượng đã được cập nhật thành ${quantity}.`,
            timer: 1500,
            showConfirmButton: false,
        });
    } catch (error) {
        console.error('Lỗi khi cập nhật số lượng:', error);

        Swal.fire({
            icon: 'error',
            title: 'Cập nhật thất bại',
            text: 'Không thể cập nhật số lượng. Vui lòng thử lại.',
        });
    }
};

// Xóa sản phẩm khỏi giỏ hàng

const removeFromCart = async (id) => {
    try {
        // Gửi yêu cầu xóa sản phẩm từ giỏ hàng
        const response = await axios.delete(`http://127.0.0.1:8000/cart/${id}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`, // Gửi token nếu cần thiết
            },
        });

        // Nếu xóa thành công, cập nhật lại giỏ hàng
        if (response.status === 200) {
            // Loại bỏ sản phẩm khỏi giỏ hàng trong frontend
            cart.value = cart.value.filter((item) => item.id !== id);
            Swal.fire({
                icon: 'success',
                title: 'Xóa sản phẩm thành công!',
                text: 'Sản phẩm đã được xóa khỏi giỏ hàng.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#69BA31',
            });
        }
    } catch (error) {
        console.error('Lỗi khi xóa sản phẩm:', error);
    }
};


// Thanh toán
const checkout = () => {
    localStorage.setItem('cart', JSON.stringify(cart.value));
    localStorage.setItem('totalAmount', totalPrice.value);
    router.push({ name: 'checkout' });
};
</script>

<template>
    <div class="container py-5">
        <h2 class="mb-4">Giỏ hàng của bạn</h2>

        <div v-if="cart.length > 0">
            <!-- Danh sách sản phẩm trong giỏ -->
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in cart" :key="item.id">
                            <td>
                                <img :src="item.product.image" alt="Product Image" class="rounded"
                                    style="width: 80px; height: 80px; object-fit: cover;" />
                            </td>
                            <td>{{ item.product.name }}</td>
                            <td>{{ formatPrice(item.product.price) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary"
                                        @click="updateQuantity(item, item.quantity - 1)">-</button>

                                    <!-- Input số lượng -->
                                    <input type="number" class="form-control mx-2 text-center" style="width: 60px;"
                                        v-model.number="item.quantity" @change="updateQuantity(item, item.quantity)" />

                                    <!-- Nút tăng số lượng -->
                                    <button class="btn btn-sm btn-outline-secondary"
                                        @click="updateQuantity(item, item.quantity + 1)">+</button>
                                </div>
                            </td>
                            <td>{{ formatPrice(item.product.price * item.quantity) }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" @click="removeFromCart(item.id)">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tổng cộng -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h4 class="fw-bold">Tổng cộng: {{ formatPrice(totalPrice) }}</h4>
                <button class="btn btn-primary btn-lg" @click="checkout">
                    Thanh toán
                </button>
            </div>
        </div>
        <div v-else class="text-center mt-5">
            <p class="text-muted fs-5">Giỏ hàng của bạn đang trống.</p>
            <router-link to="/" class="btn btn-outline-primary">Tiếp tục mua sắm</router-link>
        </div>
    </div>
</template>
<style scoped>
/* Tùy chỉnh giao diện */
.table th,
.table td {
    vertical-align: middle;
}

input[type="number"] {
    -moz-appearance: textfield;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

button {
    min-width: 36px;
}

h4 {
    color: #495057;
}
</style>