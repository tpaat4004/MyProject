<template>
  <div class="container py-5">
    <h2 class="text-center mb-4">Thông tin thanh toán</h2>
    <div class="row justify-content-center">
      <!-- Thông tin thanh toán -->
      <div class="col-md-7">
        <div class="shadow-sm p-4 mb-3">
          <h3 class="text-gray mb-3">Thanh toán đơn hàng</h3>
          <form @submit.prevent="handleCheckout">
            <!-- Tên người nhận -->
            <div class="form-group mb-3">
              <label for="recipient_name" class="form-label">Tên người nhận</label>
              <input type="text" id="recipient_name" v-model="recipientName" class="form-control" required
                placeholder="Nhập tên người nhận" />
            </div>

            <!-- Số điện thoại -->
            <div class="form-group mb-3">
              <label for="recipient_phone" class="form-label">Số điện thoại</label>
              <input type="text" id="recipient_phone" v-model="recipientPhone" class="form-control" required
                placeholder="Nhập số điện thoại" />
            </div>

            <!-- Địa chỉ giao hàng -->
            <div class="form-group mb-3">
              <label for="address" class="form-label">Địa chỉ giao hàng</label>
              <textarea id="address" v-model="address" class="form-control" rows="4" required
                placeholder="Nhập địa chỉ giao hàng"></textarea>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="form-group mb-3">
              <label for="payment_method" class="form-label">Phương thức thanh toán</label>
              <select id="payment_method" v-model="paymentMethod" class="form-control" required>
                <option value="cash">Tiền mặt khi nhận hàng</option>
                <option value="credit_card">Thẻ tín dụng</option>
                <option value="vnpay">Vnpay</option>
              </select>
            </div>

            <!-- Hiển thị tổng tiền -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5>Tổng tiền: <span class="text-primary">{{ formatPrice(totalAmount) }}</span></h5>
            </div>

            <!-- Nút Xác nhận thanh toán -->
            <button type="submit" class="btn btn-success btn-lg w-100">Xác nhận thanh toán</button>
          </form>
        </div>
      </div>

      <!-- Giỏ hàng - Bảng sản phẩm -->
      <div class="col-md-5">
        <div v-if="cart.length">
          <h5 class="text-gray mb-3">Giỏ hàng</h5>
          <!-- Bảng sản phẩm trong giỏ hàng -->
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng tiền</th>
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
                <td>{{ item.quantity }}</td>
                <td>{{ formatPrice(item.product.price * item.quantity) }}</td>
              </tr>
            </tbody>
          </table>
          <!-- Tổng tiền giỏ hàng -->
          <div class="d-flex justify-content-between">
            <strong>Tổng tiền:</strong>
            <span>{{ formatPrice(totalAmount) }}</span>
          </div>
        </div>
        <div v-else>
          <p>Giỏ hàng của bạn đang trống.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import Swal from 'sweetalert2'; // Import SweetAlert2
import axios from 'axios';

export default {
  data() {
    return {
      cart: [], // Danh sách sản phẩm từ API
      totalAmount: 0, // Tổng tiền của giỏ hàng
      recipientName: '',
      recipientPhone: '',
      address: '',
      paymentMethod: 'cash',
    };
  },
  mounted() {
    this.fetchCart();
    const route = useRoute();
    if (route.query.vnp_ResponseCode) {
      this.handleVNPayReturn(route.query);
    }
  },
  methods: {
    // Lấy dữ liệu giỏ hàng từ API
    async fetchCart() {
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://127.0.0.1:8000/cart', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.cart = response.data;
        this.calculateTotal();
      } catch (error) {
        console.error('Lỗi khi lấy giỏ hàng:', error);
        alert('Không thể tải giỏ hàng. Vui lòng thử lại.');
      }
    },

    // Tính tổng tiền
    calculateTotal() {
      this.totalAmount = this.cart.reduce((total, item) => {
        return total + item.product.price * item.quantity;
      }, 0);
    },

    formatPrice(price) {
      return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    },

    async handleVNPayReturn(query) {
      try {
        if (this.totalAmount < 5000 || this.totalAmount >= 1000000000) {
          Swal.fire({
            icon: 'error',
            title: 'Lỗi thanh toán',
            text: 'Số tiền thanh toán không hợp lệ. Vui lòng kiểm tra lại.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#FF4B4B',
          });
          return;
        }
        if (query.vnp_ResponseCode === '00') {
          Swal.fire({
            icon: 'success',
            title: 'Thanh toán thành công!',
            text: 'Đơn hàng của bạn đã được thanh toán.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#69BA31',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Thanh toán không thành công',
            text: 'Vui lòng thử lại.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#FF4B4B',
          });
        }
      } catch (error) {
        console.error('Lỗi khi xử lý VNPay return:', error);
      }
    },

    async handleCheckout() {
      const orderData = {
        recipient_name: this.recipientName,
        recipient_phone: this.recipientPhone,
        address: this.address,
        payment_method: this.paymentMethod,
        total_amount: this.totalAmount,
      };

      try {
        const token = localStorage.getItem('auth_token');

        // Tạo đơn hàng
        const response = await axios.post('http://127.0.0.1:8000/orders', orderData, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        const orderId = response.data?.order?.id; // Lấy ID đơn hàng từ phản hồi API
        if (!orderId) throw new Error('Không thể tạo đơn hàng, thiếu ID');

        if (this.paymentMethod === 'vnpay') {
          // Gửi yêu cầu tạo URL VNPay
          const paymentResponse = await axios.post(
            'http://127.0.0.1:8000/vnpay/payment',
            { order_id: orderId },
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );

          const paymentUrl = paymentResponse.data.payment_url;
          if (!paymentUrl) throw new Error('Không thể tạo URL thanh toán VNPay');

          // Điều hướng đến VNPay để thanh toán
          window.location.href = paymentUrl;

          // Gửi email sau khi thanh toán VNPay (sử dụng hàm sendEmail)
          await this.sendEmail(orderId);
        } else {
          // Gửi email xác nhận ngay sau khi thanh toán COD
          if (this.paymentMethod === 'cash') {
            await this.sendEmail(orderId);
          }

          // Xử lý các phương thức thanh toán khác (COD, Paypal,...)
          Swal.fire({
            icon: 'success',
            title: 'Thanh toán thành công!',
            text: 'Cảm ơn bạn đã mua hàng.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#69BA31',
          });

          // Điều hướng đến trang Thank You sau khi thanh toán thành công
          this.$router.push({ name: 'Thankyou1', query: { orderId, paymentMethod: this.paymentMethod, totalAmount: this.totalAmount } });
        }
      } catch (error) {
        console.error('Lỗi chi tiết:', error.response?.data || error);
        Swal.fire({
          icon: 'error',
          title: 'Lỗi',
          text: error.response?.data?.error || 'Có lỗi xảy ra. Vui lòng thử lại.',
          confirmButtonText: 'OK',
          confirmButtonColor: '#FF4B4B',
        });
      }
    },





    async sendEmail(orderId) {
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.post(`http://127.0.0.1:8000/orders/${orderId}/send-email`, null, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        console.log('Email gửi thành công:', response.data);
      } catch (error) {
        console.error('Lỗi khi gửi email:', error.response?.data || error);
        Swal.fire({
          icon: 'error',
          title: 'Lỗi gửi email',
          text: 'Không thể gửi email xác nhận. Vui lòng kiểm tra lại.',
          confirmButtonText: 'OK',
          confirmButtonColor: '#FF4B4B',
        });
      }
    }

  },
};

</script>

<style scoped>
/* Tùy chỉnh giao diện */
.shadow-sm {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-control:focus {
  border-color: #4CAF50;
  box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}

.btn-success {
  background-color: #4CAF50;
  border-color: #4CAF50;
}

.btn-success:hover {
  background-color: #45a049;
  border-color: #45a049;
}

.form-label {
  font-weight: bold;
}

h5 {
  color: #495057;
}

.table th,
.table td {
  text-align: center;
}

.table th {
  background-color: #949494;
  color: white;
}
</style>
