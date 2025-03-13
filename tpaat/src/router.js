import { createRouter, createWebHistory } from 'vue-router';

// Đảm bảo đường dẫn import đúng
import Userlayout from './components/Userlayout.vue';
import AdminLayout from './components/Adminlayout.vue';
import CategoryList from './components/categoryList.vue';
import dtb from './components/dtb.vue';
import quantityCart from './components/quantityCart.vue';
import login1 from './components/login1.vue';
import onetwo from './components/onetwo.vue';
import user from './components/user.vue';
import productsList from './components/productsList.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Products from './components/Products.vue';
import ProductsDetail from './components/ProductsDetail.vue';
import Dashboard from './components/Dashboard.vue';
import forgotPassword from './components/forgotPassword.vue';
import ResetPassword from './components/ResetPassword.vue';
import cart from './components/cart.vue';
import Checkout from './components/Checkout.vue';
import Order from './components/Order.vue';
import ordersList from './components/ordersList.vue';
import OrderDetails from './components/OrderDetails.vue';
import Profile from './components/Profile.vue';
import Thankyou from './components/Thankyou.vue';
import Thankyou1 from './components/Thankyou1.vue';
const routes = [
  // Các route sử dụng Userlayout
  {
    path: '/',
    component: Userlayout,
    children: [
      {
        path: '',
        name: 'home',
        component: Products,
      },
      {
        path: 'products',
        name: 'products',
        component: Products,
      },
      {
        path: 'ProductsDetail/:id',
        name: 'ProductsDetail',
        component: ProductsDetail,
        props: true,
      },
      {
        path: '/dtb',
        name: 'dtb',
        component: dtb,
      },
      {
        path: '/quantityCart',
        name: 'quantityCart',
        component: quantityCart,
      },
      {
        path: '/login1',
        name: 'login1',
        component: login1,
      },
      {
        path: '/onetwo',
        name: 'onetwo',
        component: onetwo,
      },
      {
        path: '/user',
        name: 'user',
        component: user,
      },
      {
        path: '/cart',
        name: 'cart',
        component: cart,
      },
      {
        path: '/order',
        name: 'order',
        component: Order,
      },
      {
        path: '/Profile',
        name: 'Profile',
        component: Profile,
      },
      {
        path: '/Thankyou',
        name: 'Thankyou',
        component: Thankyou,
      },
      {
        path: '/Thankyou1',
        name: 'Thankyou1',
        component: Thankyou1,
      },
      {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        props: (route) => ({
          cart: route.state?.cart || [],
          totalAmount: route.state?.totalAmount || 0,
        }),
      }
    ],
  },

  // Các route không sử dụng Userlayout (không có thanh nav)
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
  },
  {
    path: '/forgotPassword',
    name: 'forgotPassword',
    component: forgotPassword,
  },
  {
    path: '/reset-password',
    name: 'ResetPassword',
    component: ResetPassword,
    props: (route) => ({ token: route.query.token }), // Truyền token từ query vào component
  },

  // Các route sử dụng AdminLayout
  {
    path: '/admin',
    component: AdminLayout,
    children: [
      {
        path: 'categoryList',
        name: 'CategoryList',
        component: CategoryList,
      },
      {
        path: 'productsList',
        name: 'ProductsList',
        component: productsList,
      },
      {
        path: 'dashboard',
        name: 'Dashboard',
        component: Dashboard,
      },
      {
        path: 'ordersList',
        name: 'OrdersList',
        component: ordersList,
      },
      {
        path: "orderDetails/:id",
        name: "orderDetails",
        component: OrderDetails,
      },
      
    ],
    meta: { requiresAdmin: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Middleware kiểm tra quyền truy cập
router.beforeEach((to, from, next) => {
  const user = JSON.parse(localStorage.getItem('user'));
  const role = localStorage.getItem('role');

  if (to.meta.requiresAdmin) {
    if (role === 'admin' && user) {
      next();
    } else {
      alert('Bạn không có quyền truy cập trang này');
      next('/');
    }
  } else if ((to.name === 'login' || to.name === 'register') && user) {
    // Chặn người dùng đã đăng nhập truy cập lại login/register
    alert('Bạn đã đăng nhập!');
    next('/');
  } else {
    next(); // Không yêu cầu quyền, cho phép truy cập
  }
});

export default router;
