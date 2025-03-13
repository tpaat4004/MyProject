<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Fashion.com" ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        /* Tùy chỉnh giao diện */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        .navbar {
            background-color: #343a40;
            padding: 10px 0;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107 !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 8px 15px;
        }
        .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }
            .nav-item {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/shop"><i class="bi bi-shop"></i> Fashion.com</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/shop"><i class="bi bi-house-door"></i> Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/carts"><i class="bi bi-cart"></i> Giỏ hàng</a></li> 
                    <li class="nav-item"><a class="nav-link" href="/orders/history"><i class="bi bi-list"></i> Đơn hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="/orders/tracking"><i class="bi bi-search"></i> Tìm kiếm</a></li>         
                    <!-- Kiểm tra đăng nhập -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['user']['name']); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile"><i class="bi bi-person"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="/orders/list"><i class="bi bi-list"></i> Orders List</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register"><i class="bi bi-person-plus"></i> Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">© <?= date("Y") ?> Fashion.com - Bán quần áo chất lượng cao</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
