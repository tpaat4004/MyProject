<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            order: null, // Chi tiết đơn hàng
            items: [], // Danh sách sản phẩm trong đơn hàng
        };
    },
    methods: {
        // Lấy chi tiết đơn hàng từ API
        async fetchOrderDetails() {
            try {
                const token = localStorage.getItem("auth_token");
                const orderId = this.$route.params.id;
                const response = await axios.get(`http://127.0.0.1:8000/orders/${orderId}`, {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.order = response.data.order;
                this.items = response.data.order.items;
            } catch (error) {
                console.error(error);
                Swal.fire("Lỗi", "Không thể tải thông tin đơn hàng.", "error");
            }
        },


        // Định dạng ngày tháng
        formatDate(date) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(date).toLocaleDateString("vi-VN", options);
        },

        // Định dạng giá tiền
        formatPrice(price) {
            return price.toLocaleString("vi-VN", { style: "currency", currency: "VND" });
        },
    },
    mounted() {
        this.fetchOrderDetails();
    },
};
</script>


<template>
    <div class="order-details">
        <h2 class="mb-4 text-center">Chi tiết đơn hàng</h2>
        <div v-if="order" class="card p-4">
            <!-- Thông tin chung -->
            <h4>Thông tin đơn hàng</h4>
            <p>
                <strong>Mã đơn hàng:</strong> {{ order.id }}<br />
                <strong>Ngày đặt:</strong> {{ formatDate(order.created_at) }}<br />
                <strong>Trạng thái:</strong> {{ order.status }}
            </p>

            <!-- Thông tin người nhận -->
            <h4>Thông tin giao hàng</h4>
            <p>
                <strong>Tên người nhận:</strong> {{ order.recipient_name }}<br />
                <strong>Số điện thoại:</strong> {{ order.recipient_phone }}<br />
                <strong>Địa chỉ:</strong> {{ order.address }}
            </p>

            <!-- Sản phẩm trong đơn hàng -->
            <h4>Sản phẩm trong đơn hàng</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items" :key="item.id">
                            <td>{{ index + 1 }}</td>
                            <td>
                                <img :src="item.product.image" alt="Product Image" class="img-thumbnail"
                                    style="width: 80px;" />
                            </td>
                            <td>{{ item.product.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ formatPrice(item.product.price) }}</td>
                            <td>{{ formatPrice(item.quantity * item.product.price) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tổng tiền -->
            <div class="d-flex justify-content-between mt-4">
                <strong>Tổng tiền:</strong>
                <span class="text-primary">{{ formatPrice(order.total_amount) }}</span>
            </div>
        </div>

        <!-- Nếu không tìm thấy đơn hàng -->
        <div v-else>
            <p class="text-center">Không tìm thấy thông tin đơn hàng.</p>
        </div>
    </div>
</template>


<style scoped>
.card {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    vertical-align: middle;
}

.table th {
    text-align: center;
}

.img-thumbnail {
    border: 1px solid #ddd;
}
</style>
