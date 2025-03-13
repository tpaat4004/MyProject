<template>
  <div class="container py-5">
    <h2 class="text-center mb-4">Lịch sử đơn hàng</h2>
    <div v-if="orders.length">
      <!-- Hiển thị danh sách đơn hàng -->
      <div v-for="order in orders" :key="order.id" class="card mb-4 shadow-sm">
        <div class="card-header bg-gray ">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <strong>Mã đơn hàng:</strong> {{ order.id }}
            </div>
            <div>
              <strong>Ngày đặt:</strong> {{ formatDate(order.created_at) }}
            </div>
          </div>
        </div>
        <div class="card-body">
          <h5>Thông tin giao hàng</h5>
          <p>
            <strong>Tên người nhận:</strong> {{ order.recipient_name }}<br>
            <strong>Số điện thoại:</strong> {{ order.recipient_phone }}<br>
            <strong>Địa chỉ:</strong> {{ order.address }}<br>
            <strong>Phương thức thanh toán:</strong> {{ getPaymentMethod(order.payment_method) }}<br>
            <strong>Trạng thái:</strong> <span :class="statusClass(order.status)">{{ getStatus(order.status) }}</span>
          </p>
          <h5>Chi tiết đơn hàng</h5>
          <table class="table">
            <thead>
              <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in order.items" :key="item.id">
                <td>
                  <img :src="item.product.image" alt="Product Image" class="img-thumbnail" style="width: 80px;" />
                </td>
                <td>{{ item.product.name }}</td>
                <td>{{ item.quantity }}</td>
                <td>{{ formatPrice(item.product.price) }}</td>
                <td>{{ formatPrice(item.product.price * item.quantity) }}</td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-between">
            <strong>Tổng tiền:</strong>
            <span class="text-primary">{{ formatPrice(order.total_amount) }}</span>
          </div>
          <div v-if="order.status === 'pending'" class="mt-3 text-end">
            <button class="btn btn-danger" @click="cancelOrder(order.id)">
              Hủy đơn hàng
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <p class="text-center">Bạn chưa có đơn hàng nào.</p>
    </div>
  </div>
</template>


<script>
import axios from "axios";
import Swal from "sweetalert2";
import { onMounted, ref } from "vue";

export default {
  data() {
    return {
      orders: [], // Danh sách đơn hàng
    };
  },
  methods: {
    // Fetch danh sách đơn hàng
    async fetchOrders() {
      try {
        const token = localStorage.getItem("auth_token");
        const response = await axios.get("http://127.0.0.1:8000/orders", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.orders = response.data;
      } catch (error) {
        console.error("Lỗi khi lấy danh sách đơn hàng:", error);
        alert("Không thể tải danh sách đơn hàng. Vui lòng thử lại.");
      }
    },

    //hủy đơn hàng
    async cancelOrder(orderId) {
  try {
    console.log("Gửi yêu cầu hủy đơn hàng:", orderId);

    const token = localStorage.getItem("auth_token");
    const response = await axios.put(
      `http://127.0.0.1:8000/orders/${orderId}/cancel`,
      {},
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );

    if (response.status === 200) {
      console.log("Hủy đơn hàng thành công:", response.data);

      const order = this.orders.find((o) => o.id === orderId);
      if (order) order.status = "cancelled";
      Swal.fire({
        icon: 'success',
        title: 'Hủy đơn hàng thành công!',
        text: 'Đơn hàng đã được hủy.',
        confirmButtonColor: '#69BA31',
      });
    }
  } catch (error) {
    console.error("Lỗi khi hủy đơn hàng:", error.response || error);

    Swal.fire({
      icon: 'error',
      title: 'Không thể hủy đơn hàng',
      text: error.response?.data?.message || "Vui lòng thử lại.",
      confirmButtonColor: '#d33',
    });
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

  // Lấy tên phương thức thanh toán
  getPaymentMethod(method) {
    switch (method) {
      case "cash":
        return "Tiền mặt khi nhận hàng";
      case "credit_card":
        return "Thẻ tín dụng";
      case "paypal":
        return "Paypal";
      default:
        return "Không xác định";
    }
  },

  // Lấy trạng thái đơn hàng
  getStatus(status) {
    switch (status) {
      case "pending":
        return "Đang xử lý";
      case "paid":
        return "Đã xác nhận";
      case "shipped":
        return "Đang giao hàng"
      case "delivered":
        return "Đã giao hàng";
      case "cancelled":
        return "Đã hủy";
      default:
        return "Không rõ";
    }
  },

  // Thêm class màu sắc cho trạng thái
  statusClass(status) {
    switch (status) {
      case "pending":
        return "text-warning";
      case "confirmed":
        return "text-primary";
      case "delivered":
        return "text-success";
      case "canceled":
        return "text-danger";
      default:
        return "text-muted";
    }
  },
},
mounted() {
  this.fetchOrders();
},
};
</script>


<style scoped>
.card-header {

  color: rgb(75, 75, 75);
}

.card-header strong {
  font-weight: bold;
}

.table {
  margin-top: 15px;
}

.img-thumbnail {
  border: 1px solid #ddd;
}

.text-warning {
  color: #ffc107 !important;
}

.text-primary {
  color: #007bff !important;
}

.text-success {
  color: #28a745 !important;
}

.text-danger {
  color: #dc3545 !important;
}
</style>