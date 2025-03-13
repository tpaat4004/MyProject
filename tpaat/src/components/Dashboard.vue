<template>
  <div class="dashboard-page">
    <div class="container-fluid py-4">
      <!-- Title -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Dashboard</h1>
        <button class="btn btn-primary" @click="generateReport">Generate Report</button>
      </div>

      <!-- Summary Cards -->
      <div class="row g-4">
        <div class="col-md-3" v-for="(item, index) in summaryCards" :key="index">
          <div class="card border-0 shadow-sm text-center">
            <div class="card-body">
              <h5 :class="item.titleClass">{{ item.title }}</h5>
              <h2 class="fw-bold">{{ item.value }}</h2>
              <p class="text-muted">{{ item.subtitle }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Chart Section -->
      <div class="row mt-5">
        <div class="col-md-8">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Doanh thu theo tháng</h5>
              <apex-charts :options="salesChartOptions" :series="salesChartOptions.series" type="line" height="300" />
            </div>
          </div>
        </div>


        <!-- <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Sản phẩm bán chạy</h5>
              <ul class="list-group list-group-flush">
                <li v-for="(product, index) in topProducts" :key="index"
                  class="list-group-item d-flex justify-content-between align-items-center">
                  {{ product.name }}
                  <span class="badge bg-primary rounded-pill">{{ product.sold }} sold</span>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</template>



<script setup>
import { ref, onMounted } from 'vue';
import axios from "axios";
import ApexCharts from 'vue3-apexcharts'; // Import apex-charts

// Register component
defineProps({ apexCharts: ApexCharts });

const formatCurrency = (amount) => {
  // Kiểm tra nếu số tiền là số và khác 0
  if (isNaN(amount)) return '₫0';

  // Định dạng tiền tệ mà không có phần thập phân nếu là số nguyên
  const formattedAmount = amount.toLocaleString("vi-VN", { style: "currency", currency: "VND" });

  // Nếu số tiền là một số nguyên, loại bỏ phần thập phân
  return formattedAmount.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,').replace(/\.00$/, '');
};

const revenue = ref(0);
const revenueChange = ref(0);
const pendingOrders = ref(0);
const totalUsers = ref(0);
const totalProducts = ref(0);

// Khởi tạo `salesChartOptions` với giá trị mặc định
const salesChartOptions = ref({
  chart: {
    type: "line",
  },
  series: [],
  xaxis: {
    categories: [],
  },
  title: {
    text: "Doanh thu theo tháng",
    align: 'center',
  },
  stroke: {
    curve: 'smooth',
  },
  dataLabels: {
    enabled: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
  },
});



// Các biến dữ liệu khác cho Summary Cards
const summaryCards = ref([
  {
    title: "Doanh thu (đã giao)",
    value: formatCurrency(revenue.value),
    subtitle: `+${revenueChange.value}% so với tuần trước`,
    titleClass: "text-primary",
  },
  {
    title: "Đơn hàng chờ xử lý",
    value: pendingOrders.value,
    subtitle: "Đang xử lý",
    titleClass: "text-warning",
  },
  {
    title: "Tổng người dùng",
    value: totalUsers.value,
    subtitle: "Không thay đổi",
    titleClass: "text-success",
  },
  {
    title: "Tổng sản phẩm",
    value: totalProducts.value,
    subtitle: "Không thay đổi",
    titleClass: "text-danger",
  },
]);

async function fetchDashboardData() {
  try {
    const token = localStorage.getItem('auth_token');
    const response = await axios.get("http://127.0.0.1:8000/dashboard-summary", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    const data = response.data;
    revenue.value = data.total_revenue;
    pendingOrders.value = data.pending_orders;
    totalUsers.value = data.total_users;
    totalProducts.value = data.total_products;

    // Cập nhật các summary cards
    summaryCards.value = [
      {
        title: "Doanh thu (đã giao)",
        value: formatCurrency(revenue.value),
        subtitle: `+${revenueChange.value}% so với tuần trước`,
        titleClass: "text-primary",
      },
      {
        title: "Đơn hàng chờ xử lý",
        value: pendingOrders.value,
        subtitle: "Đang xử lý",
        titleClass: "text-warning",
      },
      {
        title: "Tổng người dùng",
        value: totalUsers.value,
        subtitle: "Không thay đổi",
        titleClass: "text-success",
      },
      {
        title: "Tổng sản phẩm",
        value: totalProducts.value,
        subtitle: "Không thay đổi",
        titleClass: "text-danger",
      },
    ];

    // Cập nhật cấu hình cho biểu đồ
    salesChartOptions.value = {
      chart: {
        type: "line",
      },
      series: [
        {
          name: "Doanh thu",
          data: data.revenue_by_month, // Dữ liệu doanh thu theo tháng
        },
      ],
      xaxis: {
        categories: data.months, // Dữ liệu tháng
      },
      title: {
        text: "Doanh thu theo tháng",
        align: 'center',
      },
      stroke: {
        curve: 'smooth', // Đường cong mượt mà
      },
      dataLabels: {
        enabled: false, // Tắt nhãn trên các điểm dữ liệu
      },
      tooltip: {
        shared: true,
        intersect: false,
      },
    };
  } catch (error) {
    console.error("Error fetching dashboard data:", error);
  }
}



onMounted(() => {
  fetchDashboardData();
});

const generateReport = () => {
  console.log("Đang tạo báo cáo...");
};
</script>





<style scoped>
/* Custom Styles for Dashboard */
.dashboard-page {
  background-color: #f8f9fa;
}

.card-title {
  font-size: 1.1rem;
}

#sales-chart {
  background: #f1f1f1;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  color: #aaa;
}
</style>