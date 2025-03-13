import { createApp } from 'vue';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import router from './router.js'; // Đảm bảo đường dẫn chính xác



import '@fortawesome/fontawesome-free/css/all.min.css';


createApp(App).use(router).mount('#app'); // Tích hợp router và khởi chạy app