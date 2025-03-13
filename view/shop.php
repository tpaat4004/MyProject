<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Quần Áo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .product img {
            transition: transform 0.3s;
        }

        .product:hover img {
            transform: scale(1.05);
        }

        .sidebar {
            background: #f8f9fa;
            padding: 15px;
            margin-top: 60px;
            border-radius: 8px;
            height: 100%;
        }

        .sidebar a {
            display: block;
            padding: 5px 0;
            cursor: pointer;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .sidebar a:hover {
            color: #007bff;
        }

        .search-bar {
            margin-bottom: 15px;
        }

        .search-bar {
            max-width: 350px;
            margin: auto;
        }

        .search-bar input {
            border-radius: 50px;

            transition: all 0.3s ease-in-out;
            border: 2px solid #ddd;
            font-size: 14px;
        }

        .search-bar input:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
            outline: none;
        }

        .search-bar button {
            border-radius: 50px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            transition: all 0.3s;
            border: none;
        }



        .search-bar i {
            font-size: 16px;
        }

        .product-item {
            display: flex;
        }

        .product {
            width: 100%;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product img {
            object-fit: cover;
            height: 250px;
            /* Điều chỉnh chiều cao ảnh */
            width: 100%;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
        }

        .card-text {
            font-size: 14px;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <img src="/uploads/banner-coupon.png" alt="Banner" class="img-fluid mb-3 rounded" style="margin-left: 130px; height: 500px;">
    </div>

    <div class="container mt-4">
        <div class="row">
            <aside class="col-md-3 sidebar">
                <h4>Danh mục</h4>
                <div id="categoryList">
                    <a href="#" data-category="all" class="category-link">Tất cả</a>
                    <?php foreach ($categories as $category): ?>
                        <a href="#" data-category="<?= $category['id'] ?>" class="category-link"> <?= htmlspecialchars($category['name']) ?> </a>
                    <?php endforeach; ?>
                </div>
            </aside>

            <main class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="input-group search-bar">
                        <input type="text" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                        <button class="btn btn-primary" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <select id="sort" class="form-select w-25">
                        <option value="default">Sắp xếp</option>
                        <option value="price_asc">Giá tăng dần</option>
                        <option value="price_desc">Giá giảm dần</option>
                        <option value="name_asc">Tên A-Z</option>
                        <option value="name_desc">Tên Z-A</option>
                    </select>
                </div>

                <h2 class="text-center mb-4">Sản phẩm mới</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4" id="productList">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-4 product-item" data-price="<?= $product['price'] ?>" data-name="<?= htmlspecialchars($product['name']) ?>" data-category="<?= $product['category_id'] ?>">
                            <div class="card product">
                                <img src="<?= $product['images'][0]['image_path'] ?? 'https://via.placeholder.com/300' ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"> <?= htmlspecialchars($product['name']) ?> </h5>
                                    <p class="card-text text-danger"> <?= number_format($product['price'], 0, ',', '.') ?>đ </p>
                                    <a href="/product_detail/<?= $product['id'] ?>" class="btn btn-outline-primary">Xem ngay</a>
                                    <a id="addToFavorite" href="/favourite/add/<?= $product['id'] ?>" class="btn btn-primary btn-favorite">Thêm vào yêu thích</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>


    <!-- <?php
$isFavorite = isset($_SESSION['user']['id']) ? $favoriteModel->isFavorite($_SESSION['user']['id'], $product['id']) : false;
?>

<button class="btn-favorite" data-product-id="<?= $product['id'] ?>" style="background: <?= $isFavorite ? 'red' : 'gray' ?>;">
     Yêu thích
</button>

<script>
    document.querySelectorAll('.btn-favorite').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');
            let isFavorite = this.style.background === 'red';

            fetch(isFavorite ? '/favorite/remove' : '/favorite/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.style.background = isFavorite ? 'gray' : 'red';
                } else {
                    alert(data.message);
                }
            });
        });
    });
</script> -->

    <script>
        document.querySelectorAll('.category-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                let selectedCategory = this.getAttribute('data-category');
                document.querySelectorAll('.product-item').forEach(item => {
                    item.style.display = selectedCategory === 'all' || item.dataset.category === selectedCategory ? 'block' : 'none';
                });
            });
        });

        document.getElementById('sort').addEventListener('change', function() {
            let products = [...document.querySelectorAll('.product-item')];
            let sortBy = this.value;

            if (sortBy === 'price_asc') {
                products.sort((a, b) => a.dataset.price - b.dataset.price);
            } else if (sortBy === 'price_desc') {
                products.sort((a, b) => b.dataset.price - a.dataset.price);
            } else if (sortBy === 'name_asc') {
                products.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
            } else if (sortBy === 'name_desc') {
                products.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
            }

            let container = document.getElementById('productList');
            container.innerHTML = '';
            products.forEach(product => container.appendChild(product));
        });

        document.getElementById('searchBtn').addEventListener('click', function() {
            let searchValue = document.getElementById('search').value.toLowerCase();
            document.querySelectorAll('.product-item').forEach(item => {
                let name = item.dataset.name.toLowerCase();
                item.style.display = name.includes(searchValue) ? 'block' : 'none';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>