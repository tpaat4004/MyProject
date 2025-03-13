<template>
    <div class="container py-5">
      <div class="row">
        <!-- Danh mục sản phẩm -->
        <div class="col-md-3 mb-4">
          <div class="list-group shadow-sm">
            <div class="list-group-item  bg-light text-dark font-weight-bold">
              <h5 class="m-0">Danh mục sản phẩm</h5>
            </div>
            <div 
              v-for="category in categories"
              :key="category.id"
              @click="getProducts(category.id)"
              :class="['list-group-item', { 'category-active': selectedCategory === category.id }]"
              style="cursor: pointer;"
            >
              {{ category.name }}
            </div>
          </div>
        </div>
  
        <!-- Sản phẩm của danh mục -->
        <div class="col-md-9">
          <h3 class="mb-4 text-secondary">Sản phẩm</h3>
          <div v-if="products.length > 0" class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col" v-for="product in products" :key="product.id">
              <div 
                class="card h-100 shadow border-light rounded"
                @click="goToProductDetail(product.id)"
                style="cursor: pointer;"
              >
                <img 
                  v-if="product.image" 
                  :src="product.image" 
                  alt="Product Image" 
                  class="card-img-top" 
                  style="object-fit: cover; height: 300px;"
                />
                <div class="card-body d-flex flex-column justify-content-between">
                  <h5 class="card-title text-truncate">{{ product.name }}</h5>
                  <p class="card-text text-success fw-bold">{{ formatPrice(product.price) }}</p>
                </div>
              </div>
            </div>
          </div>
          <div v-else class="text-center mt-4">
            <p class="text-muted">Không có sản phẩm trong danh mục này.</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  const categories = ref([]);
  const products = ref([]);
  const selectedCategory = ref(null);
  const router = useRouter();
  const API_URL = 'http://127.0.0.1:8000';  // Đảm bảo đường dẫn đúng
  
  // Lấy danh sách danh mục sản phẩm
  onMounted(async () => {
    try {
      const response = await axios.get(`${API_URL}/categories`);
      categories.value = response.data;
      getProducts();  // Lấy tất cả sản phẩm khi mới vào trang
    } catch (error) {
      console.error('Lỗi khi lấy danh mục:', error);
      alert('Không thể tải danh mục sản phẩm');
    }
  });
  
  // Lấy sản phẩm theo danh mục
  const getProducts = async (categoryId = null) => {
    try {
      let url = `${API_URL}/products`;  // Mặc định lấy tất cả sản phẩm
      selectedCategory.value = categoryId;
      if (categoryId) {
        url = `${API_URL}/categories/${categoryId}/products`;  // Nếu có categoryId, lấy sản phẩm theo danh mục
      }
      const response = await axios.get(url);
      products.value = response.data;
    } catch (error) {
      console.error('Lỗi khi lấy sản phẩm:', error);
      alert('Không thể tải sản phẩm');
    }
  };
  
  // Định dạng giá sản phẩm
  const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
  };
  
  // Chuyển hướng đến trang chi tiết sản phẩm
  const goToProductDetail = (id) => {
    router.push(`/ProductsDetail/${id}`);
  };
  </script>
  
  <style scoped>
/* Danh mục */
.list-group-item {
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.list-group-item:hover {
  background-color: #f1f1f1;
}

  /* Sản phẩm */
  .card {
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .card-body {
    padding: 1.5rem;
  }
  
  .card-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
  }
  
  .card-text {
    font-size: 0.9rem;
  }
  
  .card-footer {
    background-color: transparent;
  }
  
  .card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    object-fit: cover;
    height: 250px;
  }
  
  /* Thiết kế responsive */
  @media (max-width: 768px) {
    .card-title {
      font-size: 1rem;
    }
    .card-text {
      font-size: 0.9rem;
    }
  }
  </style>
  