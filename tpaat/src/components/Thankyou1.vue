<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Cảm ơn bạn đã mua hàng!</h2>
      <div class="row justify-content-center">
        <div class="col-md-7">
          <div class="shadow-sm p-4 mb-3">
            <h3 class="text-success mb-3">Thanh toán thành công</h3>
            <p class="text-muted">Đơn hàng của bạn đã được xử lý và sẽ được giao sớm. Cảm ơn bạn đã tin tưởng và mua sắm tại cửa hàng của chúng tôi.</p>
            <p><strong>Mã đơn hàng:</strong> {{ orderId }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ paymentMethod }}</p>
            <p><strong>Tổng tiền:</strong> {{ formatPrice(totalAmount) }}</p>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" @click="goHome">Quay lại trang chủ</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  export default {
    setup() {
      const route = useRoute();
      const router = useRouter();
  
      // Khai báo các biến sử dụng ref
      const orderId = ref(null);
      const paymentMethod = ref('');
      const totalAmount = ref(0);
  
      // Lấy thông tin đơn hàng từ URL khi component mounted
      onMounted(() => {
        orderId.value = route.query.orderId || 'Không có mã đơn hàng';
        paymentMethod.value = route.query.paymentMethod || 'Không có thông tin';
        totalAmount.value = route.query.totalAmount || 0;
      });
  
      // Hàm định dạng giá
      const formatPrice = (price) => {
        return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
      };

      
  
      // Chức năng quay lại trang chủ
      const goHome = () => {
        router.push('/'); // Quay lại trang chủ
      };
  
      return {
        orderId,
        paymentMethod,
        totalAmount,
        formatPrice,
        goHome,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Tùy chỉnh giao diện */
  .shadow-sm {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .text-success {
    color: #28a745;
  }
  
  .text-muted {
    color: #6c757d;
  }
  
  h2 {
    color: #495057;
  }
  
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }
  
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  </style>
  