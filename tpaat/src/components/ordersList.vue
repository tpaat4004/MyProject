<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      orders: [], // Danh sách đơn hàng
    };
  },
  methods: {
    // Lấy danh sách tất cả đơn hàng
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
        Swal.fire("Lỗi", "Không thể tải danh sách đơn hàng. Vui lòng thử lại.", "error");
      }
    },

    // Cập nhật trạng thái đơn hàng
    async updateOrderStatus(orderId, status) {
      try {
        const token = localStorage.getItem("auth_token");
        await axios.put(
          `http://127.0.0.1:8000/orders/${orderId}`,
          { status },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        Swal.fire("Thành công", "Trạng thái đơn hàng đã được cập nhật.", "success");
      } catch (error) {
        console.error("Lỗi khi cập nhật trạng thái:", error);
        Swal.fire("Lỗi", "Không thể cập nhật trạng thái. Vui lòng thử lại.", "error");
      }
    },

    // Chuyển hướng xem chi tiết đơn hàng
    viewOrderDetails(orderId) {
      this.$router.push({ name: "orderDetails", params: { id: orderId } });
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
    this.fetchOrders();
  },
};
</script>

<template>
    <div class="orders-list">
      <h2 class="mb-4 text-center">Quản lý đơn hàng</h2>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Mã đơn hàng</th>
              <th>Khách hàng</th>
              <th>Ngày đặt</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, index) in orders" :key="order.id">
              <td>{{ index + 1 }}</td>
              <td>{{ order.id }}</td>
              <td>{{ order.recipient_name }}</td>
              <td>{{ formatDate(order.created_at) }}</td>
              <td>{{ formatPrice(order.total_amount) }}</td>
              <td>
                <select
                  v-model="order.status"
                  @change="updateOrderStatus(order.id, order.status)"
                  class="form-select"
                >
                  <option value="pending">Đang xử lý</option>
                  <option value="paid">Đã xác nhận</option>
                  <option value="shipped">Đang giao hàng</option>
                  <option value="delivered">Đã giao hàng</option>
                  <option value="cancelled">Đã hủy</option>
                </select>
              </td>
              <td>
                <button
                  @click="viewOrderDetails(order.id)"
                  class="btn btn-primary btn-sm"
                >
                  Xem chi tiết
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <style scoped>
.table th,
.table td {
  vertical-align: middle;
}

.table th {
  text-align: center;
}

.table-responsive {
  margin-top: 20px;
}

select.form-select {
  width: auto;
  display: inline-block;
}
</style>
