<template>
  <div class="container py-5">
    <h2 class="mb-4">Chi tiết sản phẩm</h2>
    <div v-if="product" class="row">
      <div class="col-md-6">
        <div class="card shadow-sm border-light">
          <img
            v-if="product.image"
            :src="product.image"
            class="card-img-top rounded"
            alt="Product Image"
            style="object-fit: contain; height: 400px; width: 100%;"
          />
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <h5 class="card-title text-dark">{{ product.name }}</h5>
          <p class="card-text text-muted">{{ product.description }}</p>
          <p class="card-text text-success fw-bold">Giá: {{ formatPrice(product.price) }}</p>
          <p class="card-text"><strong>Số lượng: </strong>{{ product.quantity }}</p>
          <button class="btn btn-primary mt-3 w-100" @click="addToCart(product)">
            Thêm vào giỏ hàng
          </button>
        </div>
      </div>
    </div>
    <div v-else class="text-center mt-4">
      <p class="text-muted">Không tìm thấy sản phẩm này.</p>
    </div>
    <!-- Hiển thị sản phẩm liên quan -->
    <div v-if="relatedProducts.length" class="mt-5">
      <h3 class="mb-4">Sản phẩm liên quan</h3>
      <div class="row">
        <div v-for="related in relatedProducts" :key="related.id" class="col-md-3 mb-4">
          <div class="card shadow-sm border-light">
            <img
              v-if="related.image"
              :src="related.image"
              class="card-img-top rounded"
              alt="Related Product Image"
              style="object-fit: contain; height: 200px; width: 100%;"
            />
            <div class="card-body">
              <h6 class="card-title text-dark">{{ related.name }}</h6>
              <p class="card-text text-success fw-bold">{{ formatPrice(related.price) }}</p>
              <button @click="goToProductDetail(related.id)" class="btn btn-outline-primary w-100 mt-2">Xem chi tiết</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import Swal from 'sweetalert2';

const product = ref(null);
const relatedProducts = ref([]);
const API_URL = 'http://127.0.0.1:8000'; // API URL chính xác
const route = useRoute();
const router = useRouter();

// Lấy danh sách sản phẩm liên quan

const getRelatedProducts = async (id) => {
  try {
    const response = await axios.get(`${API_URL}/products/${id}/related`);
    relatedProducts.value = response.data;
  } catch (error) {
    console.error('Lỗi khi lấy danh sách sản phẩm liên quan:', error);
  }
};

// Lấy ID sản phẩm từ URL và gọi API
onMounted(() => {
  const id = route.params.id;
  getProductDetail(id);
  getRelatedProducts(id);
});


// Lấy thông tin chi tiết sản phẩm
const getProductDetail = async (id) => {
  try {
    const response = await axios.get(`${API_URL}/products/${id}`);
    product.value = response.data;
  } catch (error) {
    console.error('Lỗi khi lấy chi tiết sản phẩm:', error);
    alert('Không thể tải chi tiết sản phẩm');
  }
};

const goToProductDetail = (id) => {
    router.push(`/ProductsDetail/${id}`);
  };

// Lấy ID sản phẩm từ URL
onMounted(() => {
  const id = route.params.id;
  getProductDetail(id);
});

watch(route, (newRoute) => {
  const id = newRoute.params.id;
  getProductDetail(id);
  getRelatedProducts(id);
});

// Định dạng giá sản phẩm
const formatPrice = (price) => {
  return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
};

// Thêm sản phẩm vào giỏ hàng
const addToCart = async (product) => {
  try {
    const token = localStorage.getItem('auth_token'); // Lấy token từ localStorage

    if (!token) {
      alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng');
      return;
    }

    // Gửi yêu cầu thêm sản phẩm vào giỏ hàng
    const response = await axios.post(
      `${API_URL}/cart`,
      {
        product_id: product.id,
        quantity: 1, // Số lượng mặc định là 1
      },
      {
        headers: {
          Authorization: `Bearer ${token}`, // Gửi token trong header
        },
      }
    );

    if (response.status === 200) {
      Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: 'Sản phẩm đã được thêm vào giỏ hàng.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#69BA31' ,
      });
    }
  } catch (error) {
    console.error('Lỗi khi thêm sản phẩm vào giỏ hàng:', error);
    alert('Lỗi khi thêm sản phẩm vào giỏ hàng');
  }
};
</script>
