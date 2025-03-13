<?php




?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Fashion.vn" ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            background: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            transition: 0.3s;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            margin: 10px 0;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed a span {
            display: none;
        }
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            transition: 0.3s;
        }
        .collapsed + .content {
            margin-left: 70px;
            width: calc(100% - 70px);
        }
        .card {
            border: none;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <button class="btn btn-light w-100 mb-3" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <a href="/products"><i class="fas fa-box"></i> <span>Sản phẩm</span></a>
        <a href="/product"><i class="fas fa-list"></i> <span>Biến thể</span></a>
        <a href="/categories"><i class="fas fa-tags"></i> <span>Danh mục</span></a>
        <a href="/orders/list"><i class="fas fa-store"></i> <span>Đơn hàng</span></a>
        <a href="/users"><i class="fas fa-users"></i> <span>Người dùng</span></a>
        <a href="/coupons"><i class="fas fa-ticket"></i> <span>Mã giảm giá</span></a>
        <a href="#"><i class="fas fa-cog"></i> <span>Cài đặt</span></a>
        <a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span></a>
    </div>

    <!-- Nội dung chính -->
    <div class="content" id="content">
        

        <?= $content ?>
        
    </div>
    <!-- <main class="container my-4">
      
    </main> -->


    

</body>
</html>
